<?php

/**
 * UserIdentity represents the data needed to identify a user.
 * It contains the authentication method that checks if the provided
 * data can identify the user.
 */
class UserIdentity extends CUserIdentity
{	
	private $_id;

	/**
	 * Authenticates a user.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		if ($user === null) 
		{
			Yii::log("Username not found.", CLogger::LEVEL_INFO, "authenticate");
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if (!$user->validatePassword($this->password)) 
		{
			Yii::log("Invalid password.", CLogger::LEVEL_INFO, "authenticate");
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}			
		else
		{
			Yii::log("Authenticated.", CLogger::LEVEL_INFO, "authenticate");
			$this->errorCode=self::ERROR_NONE;
			$this->_id=$user->id;
			$this->username=$user->username;
		}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}