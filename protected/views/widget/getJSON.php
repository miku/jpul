<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');	
?>

<?php echo json_encode($models); ?>