<?php
Yii::import("xupload.models.XUploadForm");
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
			//'accessControl', // perform access control for CRUD operations
			array('authpath.filters.AuthFilter'),
		);
	}

	public function actions() {
		return array(
				'upload' => array(
					'class' => 'xupload.actions.XUploadAction', 
					'path' => Yii::app() -> getBasePath() . "/../../_pve/files/uploads", 
					'publicPath' => Yii::app()->getBaseUrl()."/../files/uploads",
					), 
				);
	}


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','admin','delete','create','update','createmulti','upload','medialijst','mediamodal'),
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
	}*/

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
		$bigMaxWidth = 640;
	    //public $bigHeight = 480;
	    $thumbWidth = 180;
	    $ThumbPrefix = "thumb_"; //Normal thumb Prefix
	    $quality = 90;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Media']))
		{
			$model->attributes=$_POST['Media'];
			$model->datumAangemaakt=date("Y-m-d H:i:s");
			$model->userAangemaakt=Yii::app()->session['personeelsnummer'];
			$model->scenario = 'create';
            $model->files=CUploadedFile::getInstance($model,'files');
           
	            
        	
			//$model->files = CUploadedFile::getInstance($model,'files');
			//$model->image1=CUploadedFile::getInstance($model,'image1');
			/*$filez = CUploadedFile::getInstancesByName('files');
			//$files = CUploadedFile::getInstance($model, 'files');
			
echo"00";print_r($_FILES) ;print_r($filez);
            // proceed if the images have been set
			if (isset($filez) && count($filez) > 0) {
				//if ($model->files != null ){
echo"11";*/	 
			if($model->validate()){

				$filespecific = $model->files;	
                // go through each uploaded image
				//foreach ($uploadFiles as $file => $filespecific) {

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
					//$fileName = str_replace('.'.$filespecific->getExtensionName(), '',$filespecific->name).'_'.date("YmdHis");
					$fileName = str_replace('.'.$filespecific->getExtensionName(), '',$_POST['Media']['naam']).'_'.date("YmdHis");
					$fileNameFull = $fileName.'.'.$filespecific->getExtensionName();
					if($extResult == 'image'){
						$imageSubfolder = 'original/';
					}else{
						$imageSubfolder = '';
					}
						
					if ($filespecific->saveAs($domain.'files/'.$extResult .'/'.$imageSubfolder.$fileNameFull)) {
						list($width, $height, $type, $attr) = getimagesize($domain.'files/'.$extResult .'/'.$imageSubfolder.$fileNameFull); 
                        // add it to the main model now
                        //$img_add = new Media();
                        $model->naam = $fileName; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                        $model->width = $width;
                        $model->height = $height;
                        $model->tbl_media_types_mediaTypesId = $filespecific->getExtensionName();
                        //$model->files=$filespecific->name;
                        //$model->tbl_media_types_mediaTypesId = $result->id;
                        $model->locatie = '/files/'.$extResult .'/'; //it might be $img_add->name for you, filename is just what I chose to call it in my model
                        //$model->tbl_media_types_mediaTypesId = 1; // this links your picture model to the main model (like your user, or profile model)
 						if($extResult == 'image'){
 							//Let's use $ImageType variable to check wheather uploaded file is supported.
						    //We use PHP SWITCH statement to check valid image format, PHP SWITCH is similar to IF/ELSE statements
						    //suitable if we want to compare the a variable with many different values
						    switch(strtolower($result->type))
						    {
						        case 'image/png':
						            $CreatedImage =  imagecreatefrompng('../files/'.$extResult .'/original/'.$fileNameFull);
						            break;
						        case 'image/gif':
						            $CreatedImage =  imagecreatefromgif($domain.'files/'.$extResult .'/original/'.$fileNameFull);
						            break;         
						        case 'image/jpeg':
						        case 'image/pjpeg':
						            $CreatedImage = imagecreatefromjpeg($domain.'files/'.$extResult .'/original/'.$fileNameFull);
						            break;
						        default:
						            die('Unsupported File!'); //output error and exit
						    }
						    //resize and save images.
						    $this->resizeImage($width,$height,$bigMaxWidth,'../files/'.$extResult .'/'.$fileNameFull,$CreatedImage,$quality,$result->type);
						    $this->resizeImage($width,$height,$thumbWidth,'../files/'.$extResult .'/thumb/'.$fileNameFull,$CreatedImage,$quality,$result->type);
						}
                        //$img_add->save(); // DONE
					}//else{
					// handle the errors here, if you want
				//}
			}
			if($model->save())
				//$model->files->saveAs(Yii::getPathOfAlias('webroot').'/files/images/');
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
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
		$model->curName=$model->naam;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		//$files = CUploadedFile::getInstancesByName('files');
		if(isset($_POST['Media']))
		{
			$model->attributes=$_POST['Media'];
			$model->datumAangepast=date("Y-m-d H:i:s");
			$model->userAangepast=Yii::app()->session['personeelsnummer'];

			if($model->save())
				//$model->files->saveAs(Yii::getPathOfAlias('webroot').'/images/images/');
				//$this->redirect(array('view','id'=>$model->id));
				if(Yii::app()->request->isAjaxRequest) { 
					$ajaxResponse = array();
        			$ajaxResponse = "succes";
					Yii::app()->clientScript->scriptMap=array((YII_DEBUG ?  'jquery.js':'jquery.min.js')=>false);
					Yii::app()->clientScript->scriptMap=array('bootstrap.js'=>false);
					$this->renderPartial('_formAjaxUpdate',array('model'=>$model, 'ajaxResponse'=>$ajaxResponse,), false, true); 
					//echo CJSON::encode(array(
                                 // 'status'=>'success'
                            // ));

					Yii::app()->end();
				} else { 
					$this->redirect(array('view','id'=>$model->id));
				} 
		}
		if(Yii::app()->request->isAjaxRequest) { 
			$this->renderPartial('_formAjaxUpdate',array('model'=>$model), false, true); 
		} else { 
			$this->render('update',array(
				'model'=>$model,
			));
		} 
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{	$model=$this->loadModel($id);
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
	{	//Yii::app()->clientScript->scriptMap=array('jquery.yiilistview.js'=>false);
		//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/masonry.min.js',CClientScript::POS_END);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);

		$model=new Media('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Media']))
			$model->attributes=$_GET['Media'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Shows media list.
	 */
	public function actionMedialijst()
	{
		$model=new Media('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Media']))
			$model->attributes=$_GET['Media'];

		$this->render('medialijst',array(
			'model'=>$model,
		));
	}

	/**
	 * Shows media modal.
	 */
	public function actionMediamodal()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);
		$dataProvider=new CActiveDataProvider('Media');
		$model=new Media;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Media']))
			$model->attributes=$_GET['Media'];

		$this->render('admin',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
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

	/**
	 * supports multi upload.
	 * http://www.yiiframework.com/extension/xupload
	 */
    public function actionCreatemulti()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);
		$model = new XUploadForm;
		$this -> render('createmulti', array('model' => $model, ));
	}


 
   // This function will proportionally resize image
	public function resizeImage($curWidth,$curHeight,$maxWidth,$DestFolder,$SrcImage,$Quality,$ImageType)
	{
	    //Check Image size is not 0
	    if($curWidth <= 0 || $curHeight <= 0)
	    {
	        return false;
	    }
	   
	    //Construct a proportional size of new image
	    $ImageScale         = min($maxWidth/$curWidth, $curHeight * ($maxWidth/$curWidth));
	    $NewWidth           = ceil($ImageScale*$curWidth);
	    $NewHeight          = ceil($ImageScale*$curHeight);
	    $NewCanves          = imagecreatetruecolor($NewWidth, $NewHeight);
	   
	    // Resize Image
	    if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $NewWidth, $NewHeight, $curWidth, $curHeight))
	    {
	        switch(strtolower($ImageType))
	        {
	            case 'image/png':
	                imagepng($NewCanves,$DestFolder);
	                break;
	            case 'image/gif':
	                imagegif($NewCanves,$DestFolder);
	                break;         
	            case 'image/jpeg':
	            case 'image/pjpeg':
	                imagejpeg($NewCanves,$DestFolder,$Quality);
	                break;
	            default:
	                return false;
	        }
	        //Destroy image, frees up memory
	        if(is_resource($NewCanves)) { imagedestroy($NewCanves); }
	    return true;
	    }

	}

	//ajax call for showing specific extensions
	public function actionAjaxArticleMediaRequest()
	{
		$mediaTypesId  = $_POST['mediaTypesId'];
		$dataProvider=new CActiveDataProvider('Media', array(
			'criteria'=>array(
				'condition'=>'tbl_media_types_mediaTypesId 	 = "'.$mediaTypesId.'" ',
			),
		));
		return $this->renderPartial('//media/mediamodal', array('model' => Media::model(), 'dataProvider'=>$dataProvider, true ));
		Yii::app()->end();
	}
	//ajax call for adding media to article
	public function actionAjaxAddMediaRequest()
	{
		$mediaId  = $_POST['mediaid'];
		$model=$this->loadModel($mediaId);
		//get correct image
		$posResult = strpos($model->tblMediaTypesMediaTypes->type, "/");
		$extResult = substr($model->tblMediaTypesMediaTypes->type, 0, $posResult);
	    if($extResult == "image"){
			$img = '<div class="optionimage"><img alt="'.$model->naam.'" src="'.Yii::app()->getBaseUrl().'/..'.$model->locatie.'thumb/'.$model->naam.'.'.$model->tblMediaTypesMediaTypes->extension.'" title="'.$model->naam.'" height="'.floor((180/$model->width)*$model->height).'" width="180"><span >'.$model->naam.'</span></div>';
	    }elseif($extResult == "application"){ 
	    	if($model->tblMediaTypesMediaTypes->extension == "pdf"){
	    		$img = '<div class="optionimage"><a href="'.Yii::app()->getBaseUrl().'/..'.$model->locatie.$model->naam.'.'.$model->tblMediaTypesMediaTypes->extension.'" target="_blank"><img alt="'.$model->naam.'" src="'.Yii::app()->getBaseUrl().'/img/pdf-icon.png" title="'.$model->naam.'" height="120" width="120"></a><span >'.$model->naam.'</span></div>';
	    	}elseif($model->tblMediaTypesMediaTypes->extension == "xls" || $model->tblMediaTypesMediaTypes->extension == "xlsx"){ 
	    		$img = '<div class="optionimage"><a href="'.Yii::app()->getBaseUrl().'/..'.$model->locatie.$model->naam.'.'.$model->tblMediaTypesMediaTypes->extension.'" target="_blank"><img alt="'.$model->naam.'" src="'.Yii::app()->getBaseUrl().'/img/excel-icon.png" title="'.$model->naam.'" height="120" width="120"></a><span >'.$model->naam.'</span></div>';
	    	}elseif($model->tblMediaTypesMediaTypes->extension == "doc" || $model->tblMediaTypesMediaTypes->extension == "docx"){ 
	    		$img = '<div class="optionimage"><a href="'.Yii::app()->getBaseUrl().'/..'.$model->locatie.$model->naam.'.'.$model->tblMediaTypesMediaTypes->extension.'" target="_blank"><img alt="'.$model->naam.'" src="'.Yii::app()->getBaseUrl().'/img/word-icon.png" title="'.$model->naam.'" height="120" width="120"></a><span >'.$model->naam.'</span></div>';
	    	}
	    }
		echo $img;
		Yii::app()->end();
	}
}