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

		$this->pageTitle = 'Jobangebote von ' . count($dataReader) . ' Unternehmen und Institutionen - Jobportal des Career Centers der Universität Leipzig';
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
		
		$top = array_slice($dataReader, 0, min(5, count($dataReader)));
		$topCities = array();
		foreach ($top as $key => $value) {
			array_push($topCities, $value['city']);
		}

		$this->pageTitle = 'Jobs aus ' . count($dataReader) . ' Regionen - ' . implode(', ', $topCities) . '... - Jobportal des Career Centers der Universität Leipzig';
		$this->render("cities", array("dataReader" => $dataReader));
	}

		
}
