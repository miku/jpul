<?php

	Yii::import('application.vendors.*');
	require_once('textile-2.0.0/classTextile.php');
	
	function textilize($text)
	{	
		$t = new Textile;
		// return $t->TextileThis($text);
		return $t->TextileRestricted($text, $lite=0, $noimage=1, $rel='nofollow');
	}
	
	function is_valid_email_address($email_address)
	{
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email_address);
	}
	
	// make links clickable
	function text_to_links($text) {
		// hyperlinks, starting with ...://
		$text = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $text);
		// email addresses
		// http://stackoverflow.com/questions/201323/what-is-the-best-regular-expression-for-validating-email-addresses
		$text = ereg_replace("[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})", "<a href=\"mailto:\\0\">\\0</a>", $text);
		return $text;
	}
	
	function in_array_2($needle, $haystack) {
		if ($needle == null || $haystack == null) { return false; } 
		foreach ($haystack as $key => $value) {
			if (in_array($needle, $value)) {
				return true;
			}
 		}
		return false;
	}

	// buggy
	function in_array_recursive($needle, $haystack) {
		$found = false;
		foreach ($haystack as $key => $value) {
			if (is_array($value)) {
				return in_array_recursive($needle, $value);
			} else {
				if ($value == $needle) {
					$found = true;
				}
			}
		}
		return $found;
	}


	/**
	 * Cut the text, without splitting within words.
	 * @param string the text to be splitted
	 * @param integer cut to this length (maximum)
	 * @param string replacement, defaults to '...'
	 * @return shortened string
	 */
	function cut_text_wo_wordsplit($string, $length, $replacer = '...') 
	{ 
		if(mb_strlen($string) > $length) 
			return (preg_match('/^(.*)\W.*$/', 
				mb_substr($string, 0, $length+1), $matches) ? $matches[1] : mb_substr($string, 0, $length)) . $replacer; 
		return $string; 
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
		if (mb_strlen($string) > $length) {
			$string = mb_substr($string, 0, $length+1) . $replacer;
		}
		return $string; 
	}
	
	function get_captcha_html() {
		$r = rand(100, 500);
		$s = rand(1, 5);
		$challenge_id = strtoupper('CAPTCHA_CHALLENGE_' . uniqid());
		Yii::app()->session[$challenge_id] = "" . ($r + $s);
		Yii::log($challenge_id . " ==> " . Yii::app()->session[$challenge_id], CLogger::LEVEL_INFO, "get_captcha_html");
		
		$obf_r = "";
		$str_r = $r + "";
		for ($i = 0; $i < strlen($str_r); $i++) {
			$obf_r .= "<script>document.write(\"" . substr($str_r, $i, 1) . "\");</script>";
		}
		
		return '<span class="CHALLENGE_QUESTION">' . $obf_r . ' plus ' . $s . ' ist gleich </span>' .
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

	function array_strip_tags($ary, $allowable = '')
	{
		$sanitized = $ary;
		try 
		{
			foreach ($sanitized as $key => $value) 
			{	
				if (!is_string($value)) continue;
				$sanitized[$key] = trim(strip_tags($value, $allowable));
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
			return (strcmp(mb_substr($haystack, 0, strlen($needle)), $needle)===0);
		}
		return (strcasecmp(mb_substr($haystack, 0, strlen($needle)), $needle)===0);
	}
	
	function endsWith($haystack,$needle,$case=true) {
    	if($case){return (strcmp(mb_substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
    	return (strcasecmp(mb_substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
	}
	
	function time_since($original) {
	    // array of time period chunks
	    $chunks = array(
	        array(60 * 60 * 24 * 365 , 'Jahr'),
	        array(60 * 60 * 24 * 30 , 'Monat'),
	        array(60 * 60 * 24 * 7, 'Woche'),
	        array(60 * 60 * 24 , 'Tag'),
	        array(60 * 60 , 'Stunde'),
	        array(60 , 'Minute'),
	    );
    
	    $today = time(); /* Current unix time  */
	    $since = $today - $original;
	
		if($since > 3628800) {
			$print = date("M jS", $original);
	
			if($since > 31536000) {
					$print .= ", " . date("Y", $original);
				}

			return $print;

		}
    
	    // $j saves performing the count function each time around the loop
	    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        
	        $seconds = $chunks[$i][0];
	        $name = $chunks[$i][1];
        
	        // finding the biggest chunk (if the chunk fits, break)
	        if (($count = floor($since / $seconds)) != 0) {
	            // DEBUG print "<!-- It's $name -->\n";
	            break;
	        }
	    }

		if ($name === 'Minute' && $count == 0) {
			$print = "weniger als einer Minute";
		} else {
			if (endsWith($name, 'e')) {
				$print = ($count == 1) ? '1 '.$name : "$count {$name}n";
			} else {
				$print = ($count == 1) ? '1 '.$name : "$count {$name}en";
			}			
		}

	    return "vor " . $print;
	}
	
	function format_model_location($model) {
		$result = "";
		if ($model->zipcode) { $result .= $model->zipcode . " "; }
		if ($model->city) { $result .= $model->city; }
		if ($model->state) { $result .= ', ' . $model->state; }
		if ($model->country) { $result .= ', ' . $model->country; }
		return $result;
	}
	
	function contains($haystack, $needle) {
		if ($needle === "") { return false; }
		
		$pos = mb_strpos($haystack,$needle);

		if($pos === false) {
 			return false;
		}
		else {
 			return true;
		}
	}
	
	/**
	 * Modifies a string to remove all non ASCII characters and spaces.
	 */
	function slugify($text)
	{
	    // replace non letter or digits by -
	    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
 
	    // trim
	    $text = trim($text, '-');
 
	    // transliterate
	    if (function_exists('iconv'))
	    {
	        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	    }
 
	    // lowercase
	    $text = strtolower($text);
 
	    // remove unwanted characters
	    $text = preg_replace('~[^-\w]+~', '', $text);
 
	    if (empty($text))
	    {
	        return 'n-a';
	    }
 
	    return $text;
	}
	
	function formatBytes($bytes, $precision = 2) { 
  	  	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	    $bytes = max($bytes, 0); 
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 

	    // Uncomment one of the following alternatives
	    // $bytes /= pow(1024, $pow);
	    $bytes /= (1 << (10 * $pow)); 

    	return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
	
?>