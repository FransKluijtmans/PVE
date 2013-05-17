<?php
//http://yiismart.tumblr.com/post/17706434887/create-your-own-validation-rule
class VPasswordStrength extends CValidator {
	const WEAK = 1;
	const FAIR = 2;
	const STRONG = 3;
	const HARD_TO_REMEMBER = 4;
	
	public $strength;
	
	public function validateAttribute($object, $attribute) {
		$pattern = "/^(?=.*[~!@#$%^&*()_+|}{?:><])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
		$message = "Dit wachtwoord is niet sterk genoeg.";
		
		if($this->strength==self::WEAK) {
			$pattern = "/^(?=.*[a-zA-Z0-9]).{5,}$/";
			$message = "Sorry, Your password is too weak!";
		} else if($this->strength==self::FAIR) {
			$pattern = "/^(?=.*[a-zA-Z0-9]).{8,}$/";
			$message = "Sorry, Your password is not fair at all!";
		} else if($this->strength==self::HARD_TO_REMEMBER) {
			$pattern = "/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/";
			$message = "Sorry, Your password is not Hard to rember!";
		} else {
			// Default to self::STRONG
		}
		
		if(isset($params['message'])) {
			$message = $params['message'];
		}
		
		if(!preg_match($pattern, $object->$attribute)) {
			$this->addError($object, $attribute, $message);
		}
	}
	
	public function clientValidationAttribute($object, $attribute) {
		$pattern = "/^(?=.*[~!@#$%^&*()_+|}{?:><])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/";
		$message = "Dit wachtwoord is niet sterk genoeg.";
		
		if($this->strength==self::WEAK) {
			$pattern = "/^(?=.*[a-zA-Z0-9]).{5,}$/";
			$message = "Sorry, Your password is too weak!";
		} else if($this->strength==self::FAIR) {
			$pattern = "/^(?=.*[a-zA-Z0-9]).{8,}$/";
			$message = "Sorry, Your password is not fair at all!";
		} else if($this->strength==self::HARD_TO_REMEMBER) {
			$pattern = "/^(?=.*\d(?=.*\d))(?=.*[a-zA-Z](?=.*[a-zA-Z])).{5,}$/";
			$message = "Sorry, Your password is not Hard to rember!";
		} else {
			// Default to self::STRONG
		}
		
		if(isset($params['message'])) {
			$message = $params['message'];
		}
		
		if(!preg_match($pattern, $object->$attribute)) {
			$this->addError($object, $attribute, $message);
		}
		$message = CJSON::encode($message);
		// Returns JavaScript decision maker condition
		return "if(!value.match($pattern))messages.push($message);";
	}
}