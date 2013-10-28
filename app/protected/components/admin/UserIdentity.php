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
	 * @return boolean whether authentication succeeds.
	 */
    public function authenticate()
    {
        $record = AdminUser::model()->findByAttributes(array('username'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==UserIdentity::genPassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->setState('title', $record->getFullName());

            // update user login status
            $record->status = AdminUser::STATUS_LOGGEDIN;
            $record->save();

            // set to output
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public static function genPassword($password)
    {
        $secKey = "Xyz123";
        return md5($secKey.$password);
    }
}