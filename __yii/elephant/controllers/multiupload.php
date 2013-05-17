<?php

class MediaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin-column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','view','admin','delete','create','update','createmulti'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(''),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
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
		$model=new Media;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Media']))
		{
			$model->attributes=$_POST['Media'];
			$model->datumAangemaakt=date("Y-m-d H:i:s");
			$model->userAangemaakt=Yii::app()->session['personeelsnummer'];
			$model->files=CUploadedFile::getInstance($model,'files');
			$files = CUploadedFile::getInstancesByName('files');
 
            // proceed if the images have been set
			if (isset($files) && count($files) > 0) {
 
                // go through each uploaded image
				foreach ($files as $file => $filespecific) {
					//echo $filespecific->name.'<br />';
					//$fileSort =$filespecific->getExtensionName() == //get extensions for datatype database and give specific path ){
					$criteria=new CDbCriteria;
   					$criteria->select='type';
   					$criteria->condition='extension=:extension';
					$criteria->params=array(':extension'=>$filespecific->getExtensionName());
					$result = MediaTypes::model()->find($criteria);
					$posResult = strpos($result->type, "/");
					$extResult = substr($result->type, 0, $posResult);
					$domain = str_replace("elephant", "", Yii::getPathOfAlias('webroot'));
					$fileName = str_replace('.'.$filespecific->getExtensionName(), '',$filespecific->name).'_'.date("YmdHis");
					$fileNameFull = $fileName.'.'.$filespecific->getExtensionName();
					
					if ($filespecific->saveAs($domain.'files/'.$extResult .'/'.$fileNameFull)) {
						list($width, $height, $type, $attr) = getimagesize($domain.'files/'.$extResult .'/'.$fileNameFull); 
                        // add it to the main model now
                        //$img_add = new Media();
                        $model->naam = $fileName; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                        $model->width = $width;
                        $model->height = $height;
                        $model->tbl_media_types_mediaTypesId = $filespecific->getExtensionName();
                        $model->locatie = '/files/'.$extResult .'/'; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                        //$model->tbl_media_types_mediaTypesId = 1; // this links your picture model to the main model (like your user, or profile model)
 
                        //$img_add->save(); // DONE
					}//else{
                //        // handle the errors here, if you want
				}
			}
			if($model->save())
				//$model->files->saveAs(Yii::getPathOfAlias('webroot').'/files/images/');
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionCreatemulti()
	{
		$model=new Media;
		$upload = new XUploadForm;
		$this->render('createmulti',array(
			'model'=>$model,
			'upload' => $upload,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$files = CUploadedFile::getInstancesByName('files');
		if(isset($_POST['Media']))
		{
			$model->attributes=$_POST['Media'];
			$model->datumAangepast=date("Y-m-d H:i:s");
			$model->userAangepast=Yii::app()->session['personeelsnummer'];
			$model->files=CUploadedFile::getInstance($model,'files');
			if($model->save())
				$model->files->saveAs(Yii::getPathOfAlias('webroot').'/images/images/');
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Media');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		// rk - Forward user to action "admin"
        $this->forward('admin'); 
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Media('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Media']))
			$model->attributes=$_GET['Media'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Media::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='media-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
