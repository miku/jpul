<?php

function get_fragment($name) {
	$result = '';
	
	if ($name == 'I18N') {
		$result = <<<I18N_CF
			AND country IS NOT NULL
			AND country != ''
			AND country != 'D' 
			AND country != 'BRD' 
			AND country != 'deu'
			AND country NOT LIKE '%eutschland%' 
			AND country NOT LIKE '%eutsch%' 
			AND country NOT LIKE '%ermany%'			
I18N_CF;
	} elseif ($name == 'INTERNSHIP') {
		$result = <<<INTERNSHIP_CF
			AND ( 
				(is_internship = 1 OR is_internship IS NULL)
				OR title LIKE '%praktik%' 
				OR title LIKE '%werkstud%' 
				OR title LIKE '%werksstud%'
				OR title LIKE '%studentische Hilfs%'
				OR title LIKE '%studentischen Hilfs%'
				OR title LIKE '%volontariat%'
				OR shadowtags LIKE '%shk%'
			)
INTERNSHIP_CF;
	} elseif ($name == 'MINUS_INTERNSHIP') {
		$result = <<<MINUS_INTERNSHIP_CF
			AND (is_internship = 0 OR is_internship IS NULL)
			AND NOT title LIKE '%praktik%'
			AND NOT title LIKE '%werkstud%'
			AND NOT title LIKE '%werksstud%'
			AND NOT title LIKE '%studentische Hilfs%'
			AND NOT title LIKE '%studentischen Hilfs%'
			AND NOT title LIKE '%studentische Mitar%'
			AND NOT title LIKE '%studentischen Mitar%'
MINUS_INTERNSHIP_CF;
	}

	return $result;

}

?>
