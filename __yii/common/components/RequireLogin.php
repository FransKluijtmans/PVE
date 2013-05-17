<?php
//http://www.larryullman.com/2010/07/20/forcing-login-for-all-pages-in-yii/
class RequireLogin extends CBehavior
{
	public function attach($owner)
	{
		$owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
	}
	public function handleBeginRequest($event)
	{
		if(isset($_GET['r'])){
			$bizrule = !in_array($_GET['r'],array('site/login'));
		}else{
			 $bizrule = !strstr($_SERVER['REQUEST_URI'], "/site/login");
		}
		
		if (Yii::app()->user->isGuest && $bizrule) {
			Yii::app()->user->loginRequired();
		}
	}
}
