<?php

Yii::import('application.vendors.*');
require_once('Zend/Search/Lucene.php'); // Zend Lucene Imports

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class JobController extends Controller
{
	// 6 * 7 * 24 * 60 * 60 = six weeks
	const DEFAULT_EXPIRATION_SECONDS = 3628800; 		
	
	/**
	 * Index action. Default page is 1.
	 *
	 * 'Index' serves different views for the sake of URL simplicity:
	 * 
	 *  (1) The default listing view,
	 *  (2) search result view
	 *  (3) favorites views.
	 * 
	 *  All three differ slightly in the way, the $models variable is
	 *  built up. 
	 * 
	 *  (1) The default view uses 'normal' active record queries, with
	 *      parameters concerning the page-number.
	 *  (2) 'Search' uses the zend_lucene index to find matching records:
	 *      
	 *          $index->find($query);
	 * 
	 *      An array of primary keys is built up from the results and
	 *      passed on to the 'normal' active record query procedure.
	 *
	 *  (3) Favorites are stored in a session variable, which is configured
	 *      as param in config/main.php as favStore:
	 *
	 *          'favStore' => 'ccul__favs__v1',
	 *      
	 *      To access the favorites, use anywhere:
	 * 
	 *          Yii::app()->params['favStore']
	 *
	 *      The favorites are a list of hashes, like so:
	 *
	 *      (0 => ('id' => 3, 'title' => 'Junior Programmer (m/f)', 'url' => '/job/21'))
	 *
	 *      Even though, we just use the id at the moment, we store all the stuff. 
	 *      If it's clear, we don't need it: TODO simplify 'favStore'.
	 *      
	 */
	public function actionIndex($page = 1, $sort = null, $v = "browser", $tab = 'all') {

		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
		Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
		Zend_Search_Lucene_Search_QueryParser::setDefaultOperator(Zend_Search_Lucene_Search_QueryParser::B_AND);

		$current_time = time();
		$criteria = new CDbCriteria;

		// sort criteria ...
		switch ($sort) {
			case 't': // order by job title
				$criteria->order = 'title';
				break;
			case 'u': // order by company
				$criteria->order = 'company';
				break;
			case 'o': // order by city name
				$criteria->order = 'city';
				break;
			default:
				$criteria->order = 'date_added DESC';
				break;
		}
		
		// just show the public offers, which are not expired ...
		$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
		$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
		
		if ($tab === '-internship') {
			$criteria->condition .= " AND (is_internship = 0 OR is_internship is null) ";
			$criteria->condition .= " AND NOT title LIKE '%praktik%' ";
			$criteria->condition .= " AND NOT title LIKE '%werkstud%' ";
			$criteria->condition .= " AND NOT title LIKE '%werksstud%' ";
			$criteria->condition .= " AND NOT title LIKE '%studentische Hilfs%' ";
			$criteria->condition .= " AND NOT title LIKE '%studentischen Hilfs%' ";
			$criteria->condition .= " AND NOT title LIKE '%studentische Mitar%' ";
			$criteria->condition .= " AND NOT title LIKE '%studentischen Mitar%' ";
			
		} elseif ($tab === 'internship') {
			$criteria->condition .= " AND ( (is_internship = 1 OR is_internship is null) ";
			$criteria->condition .= " OR title LIKE '%praktik%' ";
			$criteria->condition .= " OR title LIKE '%werkstud%' ";
			$criteria->condition .= " OR title LIKE '%werksstud%' ";
			$criteria->condition .= " OR title LIKE '%studentische Hilfs%' ";
			$criteria->condition .= " OR title LIKE '%studentischen Hilfs%' ";
			$criteria->condition .= " OR title LIKE '%volontariat%' ";
			$criteria->condition .= " OR shadowtags LIKE '%shk%')";
		}
		
		if ($tab === 'i11n') {
			$criteria->condition .= " AND country is not null and country != '' and country not like '%eutschland%' and country not like '%eutsch%' and country != 'D' and country != 'BRD' and country != 'deu' and country not like '%ermany%'";
		}

		// Determine the view to use ...
		$viewName = "default";

		if (isset($_GET['q']) && $_GET['q'] != '') {
			$viewName = "search";
		}
		
		if (isset($_GET['q']) && $_GET['q'] != '' && preg_match("/^\d+$/", $_GET['q'])) {
			$viewName = "direct";
		}

		if (isset($_GET['s']) && $_GET['s'] != '' && 
			isset(Yii::app()->session[Yii::app()->params['favStore']])) {
			$viewName = "favs";
		}
		
		// If a number is entered in the search field, and a job with such an
		// id exists, go directly there.
		if ($viewName == "direct") {
			$original_query = $_GET['q'];
			Yii::log("Direct to: " . $original_query, CLogger::LEVEL_INFO, __FUNCTION__);
			$criteria->condition='id=:id';
			$criteria->params=array(':id'=>$original_query);
			$model = Job::model()->cache(600)->find($criteria);
			if (!$model) {
				throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
			}
			if ($model->status_id == 2) {
				$this->redirect($this->createUrl('job/view', array('id' => $original_query)));
			} else {
				throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
			}
		}

		// Search term detected.
		if ($viewName == "search") {
			
			$index = new Zend_Search_Lucene($this->getSearchIndexStore());

			$original_query = $_GET['q'];

			if (preg_match("/( OR | AND |\"|:|~|-|\*| NOT )/", $original_query) == 0) {
				$query = trim($original_query) . '*';
				$query = preg_replace("/\s+/", "* AND ", $query);
			} else {
				$query = $original_query;
			}

			// Correct the user input to the query we are actually executing.
			$original_query = $query;
			
			Yii::log("Q: " . $query, CLogger::LEVEL_INFO, __FUNCTION__);
			
			try {
				$results = $index->find($query);
			} catch (Exception $e) {
				Yii::log("Failed Query: '" . $query . "' - Exception: " . $e, CLogger::LEVEL_INFO, __FUNCTION__);
				$this->redirect(array('index'));
			}

			$pks = array();
 			foreach ($results as $result) {
				$pks[] = $result->pk;
				// Yii::log("Search result content [". $result->pk . "]: " . 
				// 	$query_parsed->highlightMatches($result->description), CLogger::LEVEL_INFO, __FUNCTION__);
				
			}

			$total = count(Job::model()->cache(600)->findAllByAttributes(array('id' => $pks), $criteria));

			// fix number of offers per page ...
			if ($v == "embed") {
				$criteria->limit = 10;
				$criteria->offset = ($page - 1) * 10;
			} else {
				$criteria->limit = $this->items_per_page;
				$criteria->offset = ($page - 1) * $this->items_per_page;
			}

			$models = Job::model()->cache(600)->findAllByAttributes(array('id' => $pks), $criteria);

		}	

		// special pages, likes favorite filter
		if ($viewName == "favs") {
				
			if (count(Yii::app()->session[Yii::app()->params['favStore']]) == 0) {
				$this->redirect('index');
			}

			$favList = Yii::app()->session[Yii::app()->params['favStore']];
			$models = array();
			foreach ($favList as $key => $value) {
				Yii::log($key . " => " . $value['id'], CLogger::LEVEL_INFO, __FUNCTION__);
				array_push($models, Job::model()->findByPk($value['id']));
			}

			$total = count($models);

			// Favorites only have one big page
			$page = 1;
			$original_query = null;
			
		}
		
		// if the user neither searched or requested her favs, use the default view ...	
		if ($viewName == "default") {

			$total = count(Job::model()->findAll($criteria));

			// fix number of offers per page ...
			if ($v == "embed") {
				$criteria->limit = 10;
				$criteria->offset = ($page - 1) * 10;
			} else {
				$criteria->limit = $this->items_per_page;
				$criteria->offset = ($page - 1) * $this->items_per_page;
			}

			// just the default index action ...
			$models = Job::model()->cache(600)->findAll($criteria);
			
			$original_query = null;

		}
		
		if ($v == "browser") {

			$this->pageTitle = 'Jobportal der Universität Leipzig'; // ' (' . $total . ' aktuelle Jobangebote)';
			
			if (isset($original_query) && $original_query != '' ) {
				$this->pageTitle .= ' - ' . $original_query;
			}
			if (isset($page) && $page > 1) {
				$this->pageTitle .= ' - Seite ' . $page;
			} 
			
			$this->render('index', array(
				'models'=> $models, 
				'total' => $total,
				'page' => $page,
				'sort' => $sort,
				'original_query' => $original_query,
				'tab' => $tab) 
			);
			
		} elseif ($v == "json") {
			$this->layout = "v2/plain";
			$this->render('index_json', array(
				'models'=>$models, 
				'total' => $total,
				'page' => $page,
				'sort' => $sort,
				'original_query' => $original_query,
				'tab' => $tab) 
			);
			
		} elseif ($v == "embed") {			
			$this->layout = "v2/plain";
			$this->render('index_embed', array(
				'models'=>$models, 
				'total' => $total,
				'page' => $page,
				'sort' => $sort,
				'original_query' => $original_query,
				'tab' => $tab) 
			);
		}
	}
	

	
	public function actionRelated($id) {

		$model = Job::model()->findByPk($id);
		if (!$model) {
			throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
		}

		if ($model->status_id != 2) {
			throw new CHttpException(404, 'Kein Angebot mit dieser ID gefunden.');
		}

		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
    		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
		Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');

		$index = new Zend_Search_Lucene($this->getSearchIndexStore());

		$results = $index->find($model->title);
		$terms = $index->terms();
		
		
		Yii::log("Related results: " . $results, CLogger::LEVEL_INFO, __FUNCTION__);
		
		$this->render('related');
	}
	
	/**
	 * Job details.
	 */
	public function actionView($id, $from = '')
	{
		
		$model = Job::model()->cache(600)->findByPk($id);
		if (!$model) {
			throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
		}

		if ($model->status_id != 2) {
			throw new CHttpException(404, 'Kein Angebot mit dieser ID gefunden.');
		}

		// job view count:
		// select distinct COUNT(tracking_id) from request where 
		// (tracking_id AND request_uri_wo_qs_and_hostname) IS NOT NULL
		// AND request_uri_wo_qs_and_hostname = '/job/164';
		try {
			// $sql = "select distinct COUNT(tracking_id) as view_count 
			// from request where (tracking_id AND request_uri_wo_qs_and_hostname) IS NOT NULL 
			// AND request_uri_wo_qs_and_hostname = '" . $this->createUrl('job/view', array("id" => $id)) . "';";

			$sql = "select count(*) as view_count from (
				select distinct tracking_id, request_uri_wo_qs_and_hostname from 
				request where
					(tracking_id AND request_uri_wo_qs_and_hostname) IS NOT NULL AND
            		request_uri_wo_qs_and_hostname LIKE '%". $this->createUrl('job/view', array("id" => $id)) . "') as Q;";

			Yii::log("SQL: " . $sql, CLogger::LEVEL_INFO, __FUNCTION__);
			
			// Yii::log($sql, CLogger::LEVEL_INFO, "actionView");
			
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$dataReader = $command->queryRow();
			$view_count = $dataReader['view_count'];
		} catch (Exception $e) {
			Yii::log($e, CLogger::LEVEL_INFO, __FUNCTION__);
			$view_count = null;
		}
		
		$job_version = $model->job_version;
		if ($job_version == null) {
			$job_version = 1;
		}
		
		Yii::log(Yii::app()->request->userHostAddress, CLogger::LEVEL_INFO, __FILE__ . ' | ' . __FUNCTION__ . ' | ' . __LINE__);
		$this->pageTitle = 'Jobs - ' . cut_text($model->title, 50) . ' in ' . cut_text($model->city, 40) . ' - ' . strftime("%d.%m.%Y", $model->date_added);
		$this->render('v' . $job_version . '/view', array('model' => $model, 'view_count' => $view_count));
	}

	/**
	 * Download job attachment.
	 * @param integer the id of the model, whose attachment is requested
	 */
	public function actionDownload($id)
	{
		Yii::log("Initiating Download, id = " . $id, CLogger::LEVEL_INFO, __FUNCTION__);
		
		$model = Job::model()->cache(600)->findByPk($id);		
		
		if ($model) {
			Yii::log("Model exists, id = " . $id, CLogger::LEVEL_INFO, __FUNCTION__);			
			$fname = $this->getUploadFilePath('job', $id);
			
			if (file_exists($fname)) {
				
				Yii::log("File exists, filename = " . $fname, CLogger::LEVEL_INFO, __FUNCTION__);				
				$target_fname = strftime('%Y_%m_%d', $model->date_added) . '_' . $model->id . '_' . slugify($model->company . '_' . $model->title . '_' . $model->city, '_') . ".pdf";
				Yii::log("Client will see the following filename = " . $target_fname, CLogger::LEVEL_INFO, __FUNCTION__);
				
				$this->renderPartial('download', 
					// array('fname' => $fname, 'target_fname' => $target_fname), 
					array('fname' => $fname, 'target_fname' => $target_fname), 
					false, true);
			} else {
				throw new CHttpException(404, Yii::t('app', 'File could not be found, sorry.'));
			}
		} else {
			throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
		}
	}

	/**
	 * Create a new job posting.
	 */
	public function actionDraft($id = null, $version = "3")
	{
		$model = new Job;	
		$current_time = time();
		$captcha_error = false;
		
		if ($version != "3" && $version != "2" && $version != "1") {
			$version = 3;
		}

		if(isset($_POST['Job'])) {
			
			$model->job_version = $version;

			// Sanitize homepage URL ...
			$_POST['Job']['company_homepage'] = sanitize_url($_POST['Job']['company_homepage']);
			
			// strip every html tag out of every field, except '<br>'
			// $sanitized_post = array_strip_tags($_POST['Job'], '<br>');
			$sanitized_post = array_strip_tags($_POST['Job'], '<br>');
			
			// $model->attributes = $_POST['Job']; // mass assignment			
			$model->attributes = $sanitized_post; 
			
			Yii::log("Job version = " . $model->job_version, CLogger::LEVEL_INFO, __FUNCTION__);
			
			if (!isset($model->job_version) || $model->job_version == null || $model->job_version == '') {
				$model->job_version = 2;
			}

			$model->date_added = time();
			$model->status_id = 1; // "1" means draft; needs review
			
			if (!isset($sanitized_post['expiration_date']) || $sanitized_post['expiration_date'] === '') {
				$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
			} else {
				Yii::log("Expiration set manually: " . $sanitized_post['expiration_date'], CLogger::LEVEL_INFO, "actionDraft");
				$epoch_or_false = strtotime($sanitized_post['expiration_date']);
				if ($epoch_or_false && $epoch_or_false < $model->date_added + self::DEFAULT_EXPIRATION_SECONDS) {
					$model->expiration_date = $epoch_or_false;
				} else {
					$model->expiration_date = $model->date_added + self::DEFAULT_EXPIRATION_SECONDS;
				}
			}

			// generic anonymous author id
			$model->author_id = 1000;
			
			// unique ukey
			$model->ukey = gen_uuid();

			$model->attachment=CUploadedFile::getInstance($model, 'attachment');

			if ($model->validate()) {
				Yii::log("Model validated successfully.", CLogger::LEVEL_INFO, __FUNCTION__);
				
				if (captcha_passed($_POST) && $model->save()) {
					Yii::log("Captcha passed. Model saved.", CLogger::LEVEL_INFO, __FUNCTION__);
					if (isset($model->attachment)) {
						
						Yii::log("Storing uploaded file. (Filename: " . 
							$this->getUploadFilePath("job", $model->id) . 
							")", CLogger::LEVEL_INFO, __FUNCTION__);
						
						$filename = $this->getUploadFilePath("job", $model->id);
						$model->attachment->saveAs($filename);
					}
					$this->updateSearchIndex($model, "admin");
					$this->updateSearchIndex($model, "api");
					
					if ($model->title != "test") {
						Yii::log("Mailing notifications...", CLogger::LEVEL_INFO, __FUNCTION__);
						$this->mailOnDraft($model);
					} else {
						Yii::log("Suppressing e-mail notifications since job title is 'test'.", CLogger::LEVEL_INFO, __FUNCTION__);
					}
					
					$this->redirect($this->createUrl('ukey/preview', array('id' => $model->ukey)));
				} else {
					Yii::log("Captcha error or failed to save model.", CLogger::LEVEL_INFO, __FUNCTION__);
					$captcha_error = true;
				}
			}
		}

		$this->pageTitle = 'Jobangebot einstellen - Career Center Universität Leipzig';

		// $this->render('draft', array('model' => $model));
		$this->render('v' . $version .'/draft', array('model' => $model, 'captcha_error' => $captcha_error));
	}


	/**
	 * An asynchronous view. Adds or removes job with $id to or from the
	 * users favorite list. 
	 * 
	 * @param integer the id of the model, whose attachment is requested
	 */		
	public function actionToggleFavorite($id) {
		
		if (!isset(Yii::app()->session[Yii::app()->params['favStore']])) {
			Yii::app()->session[Yii::app()->params['favStore']] = array();
		}
		
		$userFavs = Yii::app()->session[Yii::app()->params['favStore']];
		$removed = false;

		foreach ($userFavs as $key => $value) {
			if ($value["id"] == $id) {
				unset($userFavs[$key]);
				$removed = true;
			}
		}
		
		if (!$removed) {
			$model = Job::model()->findByPk($id);
			if (!$model) {
				throw new CHttpException(404, Yii::t('app', 'Your request is not valid.'));
			} else {
				array_push($userFavs, 
					array(
						"id" => $id, 
						"title" => $model->title, 
						"url" => $this->createUrl('view', array('id' => $id))
					)
				);
			}
		}
		
		Yii::app()->session[Yii::app()->params['favStore']] = $userFavs;
		$this->renderPartial('_favbar');
	}	
	
	protected function mailOnDraft($model) {
		
		$newline = chr(13) . chr(10);
		
		// Email addresses are stored as string value in the options table,
		// which is simply a dumb key resp. option-value store. 
		// The key for the 'mailOnDraft' action is:
		//     on-draft-notification-email-addresses
		$email_model = Options::model()->findByAttributes(
				array("option" => "on-draft-notification-email-addresses"));
		
		$emails = $email_model->value;
		
		if ($emails != '') {
			$to      = $emails;
			$subject = '[CC-Jobportal] Neues Jobangebot erstellt (Unternehmen: ' . $model->company . ')';
			$message = 'Neues Jobangebot erstellt (' . $model->title . ')' . $newline . 
						'Unternehmen: ' . $model->company . $newline . 
						'Ort: ' . $model->city . $newline .
						'Ablauf der Bewerbungsfrist: ' . date("d.m.Y", $model->expiration_date) . $newline . $newline .
						'URL im Jobportal: http://wwwdup.uni-leipzig.de' . $this->createUrl('admin/view', array('id' => $model->id));
						
			$headers = 'From: careercenter@uni-leipzig.de' . "\r\n" .
	    		'Reply-To: careercenter@uni-leipzig.de' . "\r\n" .
	    		'X-Mailer: PHP/' . phpversion();

			if (mail($to, $subject, $message, $headers)) {
				Yii::log("Draft-Mail accepted. Sent to: " . $emails, CLogger::LEVEL_INFO, "mailOnDraft");
			} else {
				Yii::log("Draft-Mail NOT accepted.", CLogger::LEVEL_INFO, "mailOnDraft");
			}
		}
	}
	
} // EOF

