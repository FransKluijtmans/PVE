<?php

class AgendaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1-agenda';

	public function actionIndex()
	{
 
		$model=new Agenda('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['WorkOrder'])) {
			$model->attributes=$_GET['WorkOrder'];
		}

		//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.passwordStrenghCheck.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/fullcalendar/fullcalendar.min.js',CClientScript::POS_BEGIN);
		
		$this->render('index',array(
			'model'=>$model,
		));
		//$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}