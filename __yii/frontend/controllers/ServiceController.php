<?php

class ServiceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
	 * Displays the password forgotten
	 */
	public function actionWachtwoordvergeten()
	{
		$model=new WachtwoordVergetenForm;
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
		$this->render('wachtwoordvergeten',array('model'=>$model));
	}

	/**
	 * Displays the password forgotten
	 */
	public function actionAangemeldeActiviteiten()
	{
		if(Yii::app()->session['personeelsnummer']){
			//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/script.js',CClientScript::POS_END);
			$dataProvider=new CActiveDataProvider('AanmeldingActiviteit', array (
					'criteria'=>array(
						//'with'=>array('activiteit'),
						'condition'=>"t.leden_personeelsnummer = :personeelsnummer",
	    				'params'=>array(':personeelsnummer'=>Yii::app()->session['personeelsnummer']), 
						'together'=>true,
					),
				)
			);
	$criteria=new CDbCriteria;
			/*$criteria=new CDbCriteria(array(                    
	                                //'order'=>'status desc',
	                                //'with'   => array('aanmeldingActiviteit'),
	                                'condition'=>'aanmeldingActiviteit.id IS NULL',
	                                'joinType' => 'LEFT OUTER JOIN',

	                        ));*/
			$criteria->join='LEFT OUTER JOIN aanmelding_activiteit ON aanmelding_activiteit.id=t.id';
	$criteria->condition='aanmelding_activiteit.id IS NULL';

	 $criteria->together = true;
			$dataProviderNot=new CActiveDataProvider('Activiteit', array(
			            'criteria'=>$criteria,
			    ));
			/*$dataProviderNot=new CActiveDataProvider('Activiteit', array (
					'criteria'=>array(
						'with'=>array('aanmeldingActiviteit', 'aanmeldingActiviteitHasActiviteitOpties'),
						'condition'=>"t.id NOT IN (aanmeldingActiviteit.id)",
	    				//'params'=>array(':personeelsnummer'=>Yii::app()->session['personeelsnummer']),
						'together'=>true,
					),
				)
			);*/

			//correct sql:
			//SELECT activiteit.id
			//FROM  activiteit
			//LEFT OUTER JOIN `aanmelding_activiteit`
			//ON activiteit.id = aanmelding_activiteit.id
			//WHERE aanmelding_activiteit.id IS NULL

			$this->render('aangemeldeactiviteiten', array(
				'dataProvider'=>$dataProvider,
				'dataProviderNot'=>$dataProviderNot,
				)
			);
		}else{
			$this->forward('index'); 
		}
	}

	/**
	 * Updates a leden model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateLeden()
	{
		if(Yii::app()->session['personeelsnummer']){
			$model=$this->loadModelLeden();

			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);

			if(isset($_POST['Leden']))
			{
				$model->attributes=$_POST['Leden'];
				if($model->save())
					$this->redirect(array('view','id'=>$model->personeelsnummer));
			}

			$this->render('//leden/update',array(
				'model'=>$model,
			));
		}else{
			$this->forward('index'); 	
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Leden the loaded model
	 * @throws CHttpException
	 */
	public function loadModelLeden()
	{
		$model=Leden::model()->findByPk(Yii::app()->session['personeelsnummer']);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}