<html><head></head>
<body onload="onload();">
<?php 	
	require_once('Zend/Search/Lucene.php'); 
	$indexStore = "store";
	Zend_Search_Lucene_Analysis_Analyzer::setDefault(
		new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8_CaseInsensitive());
	Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
	$index = new Zend_Search_Lucene($indexStore);
	$results = null;
	if (isset($_GET['q'])) {
		$results = $index->find($_GET['q']);	
	}
?>
<form action="example-query.php" method="get" accept-charset="utf-8">
	<label for="q">Query</label> <input type="text" name="q" value="" id="q">
	<input type="submit" value="Go">
</form>
<ul>
<?php foreach ($results as $key => $value): ?>
	<li><span style="color: gray; font-weight: bold"><?php echo $value->pk ?></span> <?php echo $value->title ?></li>
<?php endforeach ?>
</ul>
<style type="text/css" media="screen">
	body { font-family: Arial, "MS Trebuchet", sans-serif; font-size: 12px; }
</style>
<script type="text/javascript" charset="utf-8">
	function onload() { document.getElementById("q").focus(); }
</script>
</body></html>