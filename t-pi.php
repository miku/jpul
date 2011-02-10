<!-- wont work -->
<?php // phpinfo(); ?> 

<!-- wont work -->
<?php // echo gethostname(); ?>

<!-- works -->
<?php // echo gethostbyname('www.myyn.org'); ?>

<!-- works -->
<?php // if (extension_loaded('gd') && function_exists('gd_info')) { echo "It looks like GD is installed"; } ?>

<?php
	$im = new imagick('uploads/example_file.pdf[0]');
	$im->setImageFormat( "jpg" );
	header( "Content-Type: image/jpeg" );
	echo $im;
?>
