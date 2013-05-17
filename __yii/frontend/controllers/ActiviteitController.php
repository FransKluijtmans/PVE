<?php

class ActiviteitController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','signup', 'alreadySignedup'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Activiteit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Activiteit']))
		{
			$model->attributes=$_POST['Activiteit'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Signing up for activity.
	 * If creation is successful, the browser will be redirected to the 'thank you' page.
	 */
	public function actionSignup($id)
	{
		$this->layout='//layouts/column2-signup';
		$model=$this->loadModel($id);

		//if user isn't logged in, set to login page.
		if(Yii::app()->user->isGuest) {
			//set url where to return after login
			Yii::app()->user->setReturnUrl(Yii::app()->createUrl('activiteit/signup', array('id' => $model->id)));
			$this->redirect(Yii::app()->createUrl('site/login'));
		}
		//get personeelsnumber from session
		$personeelnummer = Yii::app()->session['personeelsnummer']; 

		//check if customer hasn't already signed in for this activity
		if($this->loadModelAanmelding($model->id, $personeelnummer)){
			$this->redirect(array('alreadySignedup','id'=>$model->id));
		}
		$modelLeden=$this->loadModelLeden($personeelnummer);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Activiteit']))
		{
			$model->attributes=$_POST['Activiteit'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		//define format geboorteDatum
		$modelLeden->geboorteDatum = Yii::app()->dateFormatter->formatDateTime($modelLeden->geboorteDatum,'long',false);

		$this->render('signup',array(
			'model'=>$model,
			'modelLeden'=>$modelLeden,
			'step'=>'personal'
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout='//layouts/column2-signup';
		$model=$this->loadModel($id);

		//if user isn't logged in, set to login page.
		if(Yii::app()->user->isGuest) {
			//set url where to return after login
			Yii::app()->user->setReturnUrl(Yii::app()->createUrl('activiteit/signup', array('id' => $model->id)));
			$this->redirect(Yii::app()->createUrl('site/login'));
		}
		//get personeelsnumber from session
		$personeelnummer = Yii::app()->session['personeelsnummer']; 

		//check if customer has already signed in for this activity
		if(!$this->loadModelAanmelding($model->id, $personeelnummer)){
			$this->redirect(array('alreadySignedup','id'=>$model->id));
		}
		$modelLeden=$this->loadModelLeden($personeelnummer);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Activiteit']))
		{
			$model->attributes=$_POST['Activiteit'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		//define format geboorteDatum
		$modelLeden->geboorteDatum = Yii::app()->dateFormatter->formatDateTime($modelLeden->geboorteDatum,'long',false);

		$this->render('update',array(
			'model'=>$model,
			'modelLeden'=>$modelLeden,
			'step'=>'personal'
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//get dates that are in the future
		$dataProviderDateFuture=new CActiveDataProvider('activiteitData', array (
				//'pagination'=>array(
				//	'pageSize'=>2,
				//),
				'criteria'=>array(
					'with'=>array('activiteit'),
					'condition'=>'t.datum > :date',
    				'params'=>array(':date'=>date("Y-m-d")), 
					'together'=>true,
				),
			)
		);
		//get dates that are in the past
		$dataProviderDatePast=new CActiveDataProvider('activiteitData', array (
				//'pagination'=>array(
				//	'pageSize'=>2,
				//),
				'criteria'=>array(
					'with'=>array('activiteit'),
					'condition'=>'t.datum <= :date',
    				'params'=>array(':date'=>date("Y-m-d")), 
					'together'=>true,
				),
			)
		);
		$this->render('index',array(
			'modelDateFuture'=>$dataProviderDateFuture,
			'modelDatePast'=>$dataProviderDatePast,
		));

		/*
		$model=new Activiteit('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Activiteit']))
			$model->attributes=$_GET['Activiteit'];

		$this->render('index',array(
			'model'=>$model,
		));*/
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Activiteit('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Activiteit']))
			$model->attributes=$_GET['Activiteit'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Activiteit the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Activiteit::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Leden the loaded model
	 * @throws CHttpException
	 */
	public function loadModelLeden($id)
	{
		$model=Leden::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Activiteit $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='activiteit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function afterFind ()
    {
            // convert to display format
        $this->createdon = strtotime ($this->createdon);
        $this->createdon = date ('m/d/Y', $this->createdon);

        parent::afterFind ();
    }

    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Leden the loaded model
	 * @throws CHttpException
	 */
	public function loadModelAanmelding($id, $persnummer)
	{
		$model=AanmeldingActiviteit::model()->findByPk(array('id' => $id, 'leden_personeelsnummer' => $persnummer));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Displays a view when someone has signed up already.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionAlreadySignedup($id)
	{
		$this->render('alreadySignedup',array(
			'model'=>$this->loadModel($id),
		));
	}
}
