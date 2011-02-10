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

		$this->render("companies", array("dataReader" => $dataReader));
	}
	
	public function actionCities($sort = "total") {
		
		$sql = "
			select city, COUNT(*) total from job 
			where status_id = 2 AND FROM_UNIXTIME(expiration_date) > (select NOW())
			group by city 
			order by city;
		";

		switch ($sort) {
			case 'name':
				$sql = "
					select city, COUNT(*) total from job 
					where status_id = 2 AND FROM_UNIXTIME(expiration_date) > (select NOW())
					group by city 
					order by city;
				";
			break;
			
			default:
				$sql = "
					select city, COUNT(*) total from job 
					where status_id = 2 AND FROM_UNIXTIME(expiration_date) > (select NOW())
					group by city 
					order by count(*) DESC;
				";

		}

		
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$dataReader = $command->queryAll();

		$this->render("cities", array("dataReader" => $dataReader));
	}

		
}
