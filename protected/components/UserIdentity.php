<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	
	private $_id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{

		$user = User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if ($user===null) {
			Yii::log("Username not found.", CLogger::LEVEL_INFO, "authenticate");
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if (!$user->validatePassword($this->password)) {
			Yii::log("Invalid password.", CLogger::LEVEL_INFO, "authenticate");
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}			
		else
		{
			Yii::log("Authenticated.", CLogger::LEVEL_INFO, "authenticate");
			$this->errorCode=self::ERROR_NONE;
			$this->_id=$user->id;
			$this->username=$user->username;
			// Store the role in a session:
    		// $this->setState('role', $user->role);
		}
		return $this->errorCode==self::ERROR_NONE;


		// $record = User::model()->findByAttributes(array('username'=>$this->username));
		// if ($record == null) {
		// 	Yii::log("No such user.", CLogger::LEVEL_INFO, "authenticate");
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;			
		// } else {
		// 	Yii::log($record->username . " (" . $record->email . ") found.", CLogger::LEVEL_INFO, "authenticate");
		// }
		// 
		// 
		// if (crypt($_POST[""], $passwd) == $passwd) {
		// 	
		// }
		// if(!isset($users[$this->username]))
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;
		// else if($users[$this->username]!==$this->password)
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// else
		// 	$this->errorCode=self::ERROR_NONE;
		// return !$this->errorCode;
		// 
		
		// $users=array(
		// 	// username => password
		// 	'demo'=>'demo',
		// 	'admin'=>'admin',
		// );
		
		// if(!isset($users[$this->username]))
		// 	$this->errorCode=self::ERROR_USERNAME_INVALID;
		// else if($users[$this->username]!==$this->password)
		// 	$this->errorCode=self::ERROR_PASSWORD_INVALID;
		// else
		// 	$this->errorCode=self::ERROR_NONE;
		// return !$this->errorCode;
	}
	
		/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}