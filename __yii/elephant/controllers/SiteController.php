<?php

class SiteController extends Controller
{
	public function filters()
	{
		return array(
			//'accessControl',
			array('elephant.modules.auth.filters.AuthFilter- login,index,logout'),
		);
	}
	
	/*
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform only 'login' action
				'actions'=>array('login','error','logout'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform only 'login' action
				'actions'=>array('index'),
				'users'=>array('*'),
				//'roles'=>array('authenticated', 'admin')
			),
			array('allow', // allow admin user to perform 'admin' AND 'delete' AND 'index' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
				//'roles'=>array('authenticated')

			),
			array('deny',  // deny all users
				//'users'=>array('*'),
			),
		);
	}*/

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->pageTitle=  Yii::app()->name;
		//echo $user = Yii::app()->getUser();
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		//deregister juiry-ui-bootstrp
    	//Yii::app()->clientScript->scriptMap = array('jquery-ui-bootstrap.css' => false,);

    	//highcharts queries
		$criteria=new CDbCriteria;

		//aantal nieuwe leden per maand
        $dataProviderNweLeden=new CActiveDataProvider('Leden',
            array(
            	'criteria'=>array(
	           		'select'=>'date_format(datumAangemaakt, "%b-%Y") AS yearmonth, count(*) AS aantalLeden',
	           		'limit'=>12,
					'group'=>'DATE_FORMAT(datumAangemaakt, "%Y"),DATE_FORMAT(datumAangemaakt, "%m")',
	            )
            )
        );
        
        //aantal leden in groepen
        $criteria=new CDbCriteria;
        $criteria->select = 'count(*) AS aantalLeden, naam';
	    $criteria->join = 'JOIN leden_has_groepen ON leden_has_groepen.groepen_id = id';
		$criteria->group = 'id';
		$foundTasksPriority = Groepen::model()->findAll($criteria);
		$TasksPriority = array();
		foreach($foundTasksPriority as $task)
			$TasksPriority[] = array($task->naam, intval($task->aantalLeden));
			$dataProviderLedenGroepen=new CActiveDataProvider('Groepen',
			array(
				'criteria' => $criteria,
			)
        );

        //aantal totaal leden per maand
		$sql="	SELECT tots.*, (@var := @var + tots.aantalLeden) AS cc FROM(
    				SELECT DATE_FORMAT(datumAangemaakt, '%b-%Y') AS yearmonth, count(*) AS aantalLeden, datumAangemaakt
    				FROM leden
    				GROUP BY DATE_FORMAT(datumAangemaakt, '%m%Y') 
    				LIMIT 12
				) AS tots, (SELECT @var := 0) AS inc
				ORDER BY DATE_FORMAT(datumAangemaakt, '%Y'),DATE_FORMAT(datumAangemaakt, '%m') ";

		$dataProviderTotaalLeden=new CSqlDataProvider($sql, array(
    		'sort'=>array(
				'attributes'=>array(
					'cc',
					'yearmonth'
				),
			),
		));

		$this->render('index',array(
			'dataProviderNweLeden'=>$dataProviderNweLeden,
			'dataProviderTotaalLeden'=>$dataProviderTotaalLeden,
			'dataProviderLedenGroepen'=>$dataProviderLedenGroepen,
			'TasksPriority'=>$TasksPriority,
		));
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
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		$this->layout = 'login';

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
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Displays the settings page
	 */
	public function actionSettings($id)
	{
		$model=$this->loadModel($id);
		//$this->layout = 'login';

		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.passwordStrenghCheck.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);
		$this->render('settings',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		//$this->redirect(Yii::app()->loginUrl);
		Yii::app()->user->loginRequired();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Admin::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}