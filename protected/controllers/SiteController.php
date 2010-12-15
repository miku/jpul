<?php

// Textile via Utils.php
Yii::import('application.helpers.*');
require_once('Utils.php');

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			// 'captcha'=>array(
			// 	'class'=>'CCaptchaAction',
			// 	'backColor'=>0xFFFFFF,
			// ),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	/**
	 * Yii filters
	 * @return Our request filters
	 */
	public function filters()
	{
		return array('adminOnly + options');
	}
	
	public function actionOptions()
	{
		if(isset($_POST["Options"]))
		{
			$model = Options::model()->findByAttributes(array("option" => "on-draft-notification-email-addresses"));
			$emails = $_POST["Options"]["value"];

			if ($emails === '') {
				$this->redirect(array('index'));
			}
			
			$email_list = split("(,|;)", $emails);
			$updates_emails = array();
			
			foreach ($email_list as $email) {
				$email = trim($email);
				if (is_valid_email_address($email)) {
					array_push($updates_emails, $email);
				}
			}
			$model->value = implode(", ", $updates_emails);
			$model->save();
			Yii::log("New emails: " . $model->value, CLogger::LEVEL_INFO, "actionOptions");			
			Yii::app()->user->setFlash('success', "E-Mail Benachrichtigungen gehen an: " . implode(", ", $updates_emails));
			$this->redirect(array('index'));
		} else {
			$model = Options::model()->findByAttributes(array("option" => "on-draft-notification-email-addresses"));
		}
		$this->render('options', array('model' => $model));
	}
	
	
	
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		// $this->pageTitle = 'Jobportal der Universität Leipzig - Index';
		// $this->render('index');
		if (Yii::app()->user->isAdmin()) {
			Yii::app()->session['adminindexfilter'] = "pd";
			$this->redirect($this->createUrl("admin/index"));
		}
		else {
			$this->redirect($this->createUrl("job/index"));	
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	// /**
	//  * Displays the contact page
	//  */
	// public function actionContact()
	// {
	// 	$model=new ContactForm;
	// 	if(isset($_POST['ContactForm']))
	// 	{
	// 		$model->attributes=$_POST['ContactForm'];
	// 		if($model->validate())
	// 		{
	// 			$headers="From: {$model->email}\r\nReply-To: {$model->email}";
	// 			mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
	// 			Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
	// 			$this->refresh();
	// 		}
	// 	}
	// 	$this->render('contact',array('model'=>$model));
	// }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}