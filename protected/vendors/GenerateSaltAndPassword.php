<?php

	function usage($exit = true)
	{
		echo "Generates a password and salt suitable to store\n";
		echo "in the database.\n";
		echo "\n";
		echo "Options:\n";
		echo "            -u USERNAME      desired username\n";
		echo "            -e EMAIL         email address, used for salt\n";
		echo "            -p PASSWORD      password\n";
		echo "            -h               show options\n";		
		echo "\n\n";
		echo "The credentials are checked in models/User.php\n\n";
		echo "Example:\n";
		echo "\n";
		echo "  $ php GenerateSaltAndPassword.php -u admin -e a@be.com -p admin";
		echo "\n\n";		
		echo "  salt: aaecdf48a621c091571a9fd71ec0c1ffbfc4555d\n";
		echo "  cpw : aaLR8vE.jjhss\n";
		echo "\n";
		
		if ($exit) exit();
	}
	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	function cryptPassword($password,$salt)
	{
		return crypt($password, $salt);
	}
	
	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	function generateSalt($username, $email)
	{
		return sha1($username . ":" . $email);
	}

	$opts = getopt("u:e:p:h");
	
	if (isset($opts["h"])) 
		usage($exit=true);

	if (!isset($opts["u"])) 
		usage($exit=true);
	else
		$username = $opts["u"];

	if (!isset($opts["e"])) 
		usage($exit=true);
	else
		$email = $opts["e"];

	if (!isset($opts["p"]))
		usage($exit=true);
	else
		$password = $opts["p"];
	
	$salt = generateSalt($username, $email);
	$cpw = cryptPassword($password, $salt);
	
	echo "\n";
	echo "salt: " . $salt . "\n";
	echo "cpw : " . $cpw . "\n";

?>

