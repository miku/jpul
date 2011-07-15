<?php 
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');	
?>

<?php echo $callback . "(" . json_encode($models) . ")"; ?>