<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');	
?>

<?php echo $callback . "(" . json_encode(
		array("query" => $original_query, "models" => $models)) . 
	")"; 
?>