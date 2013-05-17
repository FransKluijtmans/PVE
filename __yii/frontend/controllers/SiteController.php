<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$newsdataProvider=new CActiveDataProvider('Content', array (
				'pagination'=>array(
					'pageSize'=>2,
				),
				'criteria'=>array(
					'with'=>array('contentCategories'),
					'condition'=>"content_category_id <> 2",//2 = peevee item
					'together'=>true,
				),
			)
		);
		$actdataProvider=new CActiveDataProvider('activiteitData', array (
				'criteria'=>array(
					'with'=>array('activiteit'),
					'condition'=>"datum > :date",
    				'params'=>array(':date'=>date("Y-m-d")), 
					'together'=>true,
				),
			)
		);

		Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );

		$this->render('index', array(
			'newsdataProvider'=>$newsdataProvider,
			'actdataProvider'=>$actdataProvider,
			)
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout='//layouts/column2-login';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if(Yii::app()->request->isAjaxRequest) { 
				if($model->validate() && $model->login()){
					$ajaxResponse = array();
					$ajaxResponse = "succes";
					$this->renderPartial('_loggedin',array('model'=>$model, 'ajaxResponse'=>$ajaxResponse,), false, true); 
				}else{
					$ajaxResponse = array();
					//$ajaxResponse['status'] = "error";
					//$ajaxResponse = CActiveForm::validate($model);
					//$arr = json_decode(CActiveForm::validate($model));
					$ajaxResponse['status'] = "succes";
					/*$i=1;
					foreach ($arr as $value) {
						foreach ($value as $val) {
					    $ajaxResponse[$i] = $val;
					}
					    $i++;
					}*/
					$ajaxRespons = json_encode($ajaxResponse);
					//$ajaxRespons = CActiveForm::validate($model);
					echo $ajaxResponse ; 
				}
				
				Yii::app()->end();
			}else{
				if($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->request->urlReferrer);
	}

	/**
	 * Displays the newest activities as list
	 */
	public function actionNewest()
	{
		$actdataProvider=new CActiveDataProvider('AanmeldingActiviteitHasActiviteitOpties', array (
				'criteria'=>array(
					'with'=>array('activiteitOpties','activiteit'),
					//'condition'=>"datum > :date",
    				//'params'=>array(':date'=>date("Y-m-d")), 
					'together'=>true,
				),
			)
		);

		$this->renderPartial('newestActList', array(
			'actdataProvider'=>$actdataProvider,
			)
		);
	}
}