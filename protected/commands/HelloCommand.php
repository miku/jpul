<?php

class HelloCommand extends CConsoleCommand {

	public function init()
	{
		echo "init\n";
	}

	public function run($args) {
		echo "run\n";
	}

	public function actionIndex($type) {
		echo "Index\n";
	}

}

?>