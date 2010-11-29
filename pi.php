<!-- wont work -->
<?php // phpinfo(); ?> 

<!-- wont work -->
<?php // echo gethostname(); ?>

<!-- works -->
<?php // echo gethostbyname('www.myyn.org'); ?>

<!-- works? -->
<?php if (extension_loaded('gd') && function_exists('gd_info')) { echo "It looks like GD is installed"; } ?>
