<?php 	
	header('Content-type: text/plain');
	require_once('Zend/Search/Lucene.php'); 

	$indexStore = "store";

	Zend_Search_Lucene_Analysis_Analyzer::setDefault(
		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
	Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');

	$index = new Zend_Search_Lucene($indexStore);
	
	echo "terms: " . $index->terms() . "\n";
	
	var_dump($index->terms());
?>