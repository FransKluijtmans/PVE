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
	 */
	public function authenticate()
	{
		$users = Admin::model()->findByAttributes(array('leden_personeelsnummer'=>$this->username));
		//http://www.yiiframework.com/wiki/240/authenticating-against-phpass-hashes-with-yii/
		$ph=new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'], Yii::app()->params['phpass']['portable_hashes']);

		if($users===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$ph->CheckPassword($this->password, $users->wachtwoord))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$users->id;
			$modelLeden = Leden::model()->findByPk($users->leden_personeelsnummer);
			$volledigenaam = $modelLeden->voorletters.' '.$modelLeden->voorvoegsel.' '.$modelLeden->achternaam;
			Yii::app()->session->add('functie', $users->functies_id);
			Yii::app()->session->add('personeelsnummer', $users->leden_personeelsnummer);
			Yii::app()->session->add('volledigenaam', $volledigenaam);
			Yii::app()->session->add('naam', $users->gebruiker);
			Yii::app()->session->add('id', $users->id);		
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}