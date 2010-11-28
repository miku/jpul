<?php

	Yii::import('application.vendors.*');
	require_once('textile-2.0.0/classTextile.php');

	function textilize($text)
	{	
		$t = new Textile;
		return $t->TextileRestricted($text, $lite=0, $noimage=1, $rel='nofollow');
	}

	function array_strip_tags($ary)
	{
		$sanitized = $ary;
		try 
		{
			foreach ($sanitized as $key => $value) 
			{	
				if (!is_string($value)) continue;
				$sanitized[$key] = strip_tags($value);
			}
		} 
		catch (Exception $e) 
		{
			return $ary;
		} 
		return $sanitized;
	}
	
	function startsWith($haystack, $needle, $case=true) {
		if ($case) 
		{
			return (strcmp(substr($haystack, 0, strlen($needle)), $needle)===0);
		}
		return (strcasecmp(substr($haystack, 0, strlen($needle)), $needle)===0);
}
?>