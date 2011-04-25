<?php header('Content-type: application/json'); ?>
{
    "jobs" : <?php echo $data['jobs'] ?>, 
    "active_jobs" : <?php echo $data['active_jobs'] ?>,
    "requests" : <?php echo $data['requests'] ?>,
    "first_request" : <?php echo $data['first_request'] ?>,
    "last_request" : <?php echo $data['last_request'] ?>,
    "homepage" : "http://www.uni-leipzig.de/jobportal",
    "info" : "(C) 2010 - <?php echo date("Y"); ?> Jobportal des Career Centers der Universität Leipzig",
    "address" : "Career Center, Universität Leipzig, Burgstraße 21, 1. Etage, 04109 Leipzig",
    "email" : "martin.czygan@gmail.com, claudia.schoder@uni-leipzig.de",
    "phone" : "0049 341 9730030",
    "fax" : "0049 341 9730069"
}
