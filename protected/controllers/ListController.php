<?php

Yii::import('application.helpers.*');
require_once('Utils.php');

class ListController extends Controller
{
	
	public function actionIndex() {
		$this->render("index");
	}
	
	public function actionCompanies($sort = 'total') {
		
		$sql = "
			select company, COUNT(*) total from job 
			where status_id = 2 AND FROM_UNIXTIME(expiration_date) > (select NOW())
			group by company 
			order by company;
		";

		switch ($sort) {
			case 'name':
				$sql = "select company, COUNT(*) total from job 
					where status_id = 2 AND FROM_UNIXTIME(expiration_date) > (select NOW())
					group by company 
					order by company;";
			break;
			
			default:
				$sql = "select company, COUNT(*) total from job 
					where status_id = 2 AND FROM_UNIXTIME(expiration_date) > (select NOW())
					group by company 
					order by count(*) DESC;";
				break;
		}
		
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryAll();

		$this->render("index", array("dataReader" => $dataReader));
	}
		
}
