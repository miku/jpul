<?php

	Yii::import('application.vendors.*');
	require_once('Zend/Search/Lucene.php');
	
	Yii::import('application.helpers.*');
	require_once('TabHelper.php');

	/**
	 * Get the path to the uploaded job attachments.
	 * @return Job attachments upload path
	 */
	function getDefaultSearchIndexStore()
	{
		return Yii::app()->basePath . '/runtime/search';
	}
	
	function getAdminSearchIndexStore() {
		return Yii::app()->basePath . '/runtime/adminsearch';
	}
	
	function getApiSearchIndexStore() {
		return Yii::app()->basePath . '/runtime/apisearch';
	}
	
	function getSearchIndexStore($name = 'default')
	{
		if ($name == 'default') {
			return getDefaultSearchIndexStore();
		} elseif ($name == 'admin') {
			return getAdminSearchIndexStore();
		} elseif ($name == 'api') {
			return getApiSearchIndexStore();
		}
	}
	
	function getResultSetAndSize($options) {
		return array("models" => getResultSet($options), "total" => getResultSetSize($options));
	}
	
	function getResultSetSize($options) {
		
		$default_options = array("q" => null, "offset" => 0, "limit" => 10,
			"sort" => "d", "tab" => "all");
		
		$options = array_merge($default_options, $options);
		
		$options_fingerprint = sha1(json_encode($options));
		
		$cache_key_models = "models:" . $options_fingerprint;
		$cache_key_total = "total:" . $options_fingerprint;
		
		Yii::log($cache_key_models, CLogger::LEVEL_INFO, __FUNCTION__);
		Yii::log($cache_key_total, CLogger::LEVEL_INFO, __FUNCTION__);
		
		$result_total = Yii::app()->cache->get($cache_key_total);
		
		if ($result_total == false) {

			if ($options["q"] == null) { 
				return 0;
			}
		
	        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
	            new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
	        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
	        Zend_Search_Lucene_Search_QueryParser::setDefaultOperator(Zend_Search_Lucene_Search_QueryParser::B_AND);

	        $current_time = time();
	        $criteria = new CDbCriteria;

	        // sort criteria ...
	        switch ($options["sort"]) {
				case 'd': // order by job title
					$criteria->order = 'date_added';
					break;
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
		
			// Just show the public offers, which are not expired ...
			$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
			$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
		
			if ($options["tab"] == 'all') {
				// skip
			} elseif ($options["tab"] == '-internship') {
				$criteria->condition .= get_fragment('MINUS_INTERNSHIP');            
			} elseif ($options["tab"] == 'internship') {
				$criteria->condition .= get_fragment('INTERNSHIP');
			} elseif ($options["tab"] == 'international') {
				$criteria->condition .= get_fragment('I18N');
			}		
		
			$index = new Zend_Search_Lucene(getSearchIndexStore('default'));
		
			try {
				$results = $index->find($options["q"]);
			} catch (Exception $e) {
				Yii::log('Failed to execute query: ' . $q, CLogger::LEVEL_ERROR, __FUNCTION__);
				throw $e;
			}
		
			$pks = array();
			foreach ($results as $result) {
				$pks[] = $result->pk;
			}

			$total = count(Job::model()->findAllByAttributes(array('id' => $pks), $criteria));

			$criteria->limit = $options["limit"];
			$criteria->offset = $options["offset"];
		
			$models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria);
			
			Yii::app()->cache->set($cache_key_models, serialize($models), 3600);
			Yii::app()->cache->set($cache_key_total, $total, 3600);
		}
		
		return Yii::app()->cache->get($cache_key_total);
	}
	
	function getResultSet($options) {
		
		$default_options = array("q" => null, "offset" => 0, "limit" => 10,
			"sort" => "d", "tab" => "all");
		
		$options = array_merge($default_options, $options);
		
		$options_fingerprint = sha1(json_encode($options));
		
		$cache_key_models = "models:" . $options_fingerprint;
		$cache_key_total = "total:" . $options_fingerprint;
		
		Yii::log($cache_key_models, CLogger::LEVEL_INFO, __FUNCTION__);
		Yii::log($cache_key_total, CLogger::LEVEL_INFO, __FUNCTION__);
		
		$result_total = Yii::app()->cache->get($cache_key_total);
		
		if ($result_total == false) {

			if ($options["q"] == null) { 
				return array();
			}
		
	        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
	            new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
	        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
	        Zend_Search_Lucene_Search_QueryParser::setDefaultOperator(Zend_Search_Lucene_Search_QueryParser::B_AND);

	        $current_time = time();
	        $criteria = new CDbCriteria;

	        // sort criteria ...
	        switch ($options["sort"]) {
				case 'd': // order by job title
					$criteria->order = 'date_added';
					break;
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
		
			// Just show the public offers, which are not expired ...
			$criteria->condition = 'status_id=:status_id AND expiration_date > :current_time';
			$criteria->params=array(':status_id' => 2, ':current_time' => $current_time);
		
			if ($options["tab"] == 'all') {
				// skip
			} elseif ($options["tab"] == '-internship') {
				$criteria->condition .= get_fragment('MINUS_INTERNSHIP');            
			} elseif ($options["tab"] == 'internship') {
				$criteria->condition .= get_fragment('INTERNSHIP');
			} elseif ($options["tab"] == 'international') {
				$criteria->condition .= get_fragment('I18N');
			}		
		
			$index = new Zend_Search_Lucene(getSearchIndexStore('default'));
		
			try {
				$results = $index->find($options["q"]);
			} catch (Exception $e) {
				Yii::log('Failed to execute query: ' . $q, CLogger::LEVEL_ERROR, __FUNCTION__);
				throw $e;
			}
		
			$pks = array();
			foreach ($results as $result) {
				$pks[] = $result->pk;
			}

			$total = count(Job::model()->findAllByAttributes(array('id' => $pks), $criteria));

			$criteria->limit = $options["limit"];
			$criteria->offset = $options["offset"];
		
			$models = Job::model()->findAllByAttributes(array('id' => $pks), $criteria);
			
			Yii::log("Serialized result set: " . serialize($models), CLogger::LEVEL_INFO, __FUNCTION__);
			
			
			Yii::app()->cache->set($cache_key_models, serialize($models), 3600);
			Yii::app()->cache->set($cache_key_total, $total, 3600);
		}
		
		return unserialize(Yii::app()->cache->get($cache_key_models));
	}

?>