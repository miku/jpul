<?php

	Yii::import('application.vendors.*');
	require_once('textile-2.0.0/classTextile.php');

	function textilize($text)
	{	
		$t = new Textile;
		return $t->TextileThis($text);
		// return $t->TextileRestricted($text, $lite=0, $noimage=1, $rel='nofollow');
	}
	
	/**
	 * Cut the text, without splitting within words.
	 * @param string the text to be splitted
	 * @param integer cut to this length (maximum)
	 * @param string replacement, defaults to '...'
	 * @return shortened string
	 */
	function cut_text($string, $length, $replacer = '...') 
	{ 
		if(strlen($string) > $length) 
			return (preg_match('/^(.*)\W.*$/', 
				mb_substr($string, 0, $length+1), $matches) ? $matches[1] : mb_substr($string, 0, $length)) . $replacer; 
		return $string; 
	}
	
	function get_captcha_html() {
		$r = rand(100, 500);
		$s = rand(1, 5);
		$challenge_id = strtoupper('CAPTCHA_CHALLENGE_' . uniqid());
		Yii::app()->session[$challenge_id] = "" . ($r + $s);
		Yii::log($challenge_id . " ==> " . Yii::app()->session[$challenge_id], CLogger::LEVEL_INFO, "get_captcha_html");
		
		return '<span class="CHALLENGE_QUESTION">' . $r . ' + ' . $s . ' = </span>' .
			'<input type="hidden" value="' . $challenge_id . '" name="CHALLENGE_ID" />' . 
			'<input size="8" name="CHALLENGE_ANSWER" id="challenge_answer" type="text" maxlength="255" value="" />';
	}
	
	function captcha_passed($post_hash) 
	{
		Yii::log("Verifing captcha...", CLogger::LEVEL_INFO, "captcha_passed");

		foreach (array_keys($post_hash) as $k) {
			Yii::log($k, CLogger::LEVEL_INFO, "captcha_passed");
		}
		
		if (isset($post_hash["CHALLENGE_ID"]) && isset($post_hash["CHALLENGE_ANSWER"])) {
			
			Yii::log($post_hash["CHALLENGE_ID"], CLogger::LEVEL_INFO, "captcha_passed");
			
			$challenge_id = $post_hash["CHALLENGE_ID"];
			
			if (isset(Yii::app()->session[$challenge_id])) {
				
				$captcha_passed = ($post_hash["CHALLENGE_ANSWER"] == Yii::app()->session[$challenge_id]);

				Yii::log($post_hash["CHALLENGE_ANSWER"], CLogger::LEVEL_INFO, "captcha_passed");
				Yii::log(Yii::app()->session[$challenge_id], CLogger::LEVEL_INFO, "captcha_passed");
				Yii::log($captcha_passed, CLogger::LEVEL_INFO, "captcha_passed");
				
				unset(Yii::app()->session[$challenge_id]); 
				return $captcha_passed;
			}
		}
		return false;
	}
	
	function recapchta_passed($privatekey, $remote_addr, $post_hash) 
	{
		if (isset($post_hash["recaptcha_challenge_field"])) {
			
	  		$resp = recaptcha_check_answer($privatekey,
	                                $remote_addr,
	                                $post_hash["recaptcha_challenge_field"],
	                                $post_hash["recaptcha_response_field"]);

			return ($resp->is_valid);
		}
		return true;
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