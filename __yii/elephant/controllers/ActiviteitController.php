<?php

class ActiviteitController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
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
		/*if(Yii::app()->session['step2']){
		$modelClients=array();
		foreach(Yii::app()->session['step2'] as $i=>$arrayItem){
 			$modelClients[$i] = new ActiviteitData;
 			$a = Yii::app()->session->get('step1');
 			$modelClients[$i]->eindDatum = $a['eindDatum'];
 		}

		 if(Yii::app()->getRequest()->getIsAjaxRequest()) {
		    echo CActiveForm::validateTabular(  $modelClients );
		    Yii::app()->end();
		 }
		}*/
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(/*isset($_POST['Activiteit']) && */ isset($_POST['step2']) || isset($_POST['step2back'])){
			
			//Create Step 2 - Dates
			//----------------------------------------------------
			if(isset($_POST['Activiteit'])){
				//data step - step 2
				Yii::app()->session->add('step1',$_POST['Activiteit']);// save step1 into form state (session works better then setPageState for back functionality)

				//$this->setPageState('step1',$_POST['Activiteit']); // save step1 into form state
	  			$model=new Activiteit('step1');
				$model->attributes=$_POST['Activiteit'];
				$model->scenario = 'step1';
			}else{
	  			$model=new Activiteit('step1');
	  			$model->attributes=Yii::app()->session->get('step1');
				//$model->attributes=Yii::app()->session->get('step2');

				$model->scenario = 'step1';

				/*$modelActiviteitData=new ActiviteitData;
				$modelActiviteitData->attributes=Yii::app()->session->get('step2');
				foreach(Yii::app()->session['step2'] as $i=>$item){
					$modelActiviteitData[$i]->datum=Yii::app()->session['step2'][$i]['datum'];
					$modelActiviteitData->tijdstip[]=Yii::app()->session['step2'][$i]['tijdstip'];
					$modelActiviteitData->maxInschrijving[]=Yii::app()->session['step2'][$i]['maxInschrijving'];
				}*/
			}
			//if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
			if($model->validate()){
				//$modelActiviteitData = array();
				$modelActiviteitData=new ActiviteitData;
				//$modelActiviteitData->maxInschrijving = $aa['1']['maxInschrijving'];
				/*foreach($aa as $i=>$item)
			        {
			            if(isset($aa[$i]['maxInschrijving']))
			            	//echo  $item['maxInschrijving'] ;
			            	//echo $aa[$i]['maxInschrijving'];
			                $modelActiviteitData->maxInschrijving=$aa[$i]['maxInschrijving'] ;
			                
			            //$valid=$item->validate() && $valid;
			        }*/
				$prepopulate = false;//decides when validation gives a no go to prepopulate step2.
				$this->render('create',array(
					'model'=>$model,
					'modelActiviteitData'=>$modelActiviteitData,
					'step'=>'_formStep2',
					'prepopulate'=> $prepopulate,
				));
			}else{
				$this->render('create',array(
					'model'=>$model,
					'step'=>'_form'
				));
			}
		}elseif(isset($_POST['ActiviteitData']) && isset($_POST['step3'])){

			//Create Step 3 - Options
			//----------------------------------------------------
			//$this->getPageState('step2',$_POST['Activiteit']); // save step2 into form state
  			//$model=new Activiteit('step2');
  			//$model->attributes=$_POST['Activiteit'];
  			//$model->attributes = $this->getPageState('step1',array());
			Yii::app()->session->add('step2',$_POST['ActiviteitData']);// save step1 into form state (session works better then setPageState for back functionality)
  			//$this->setPageState('step2',$_POST['ActiviteitData']); // save step2 into form state
  			$model=new Activiteit('step2');
  			$model->attributes=Yii::app()->session->get('step1');
  			//$model->attributes = $this->getPageState('step1',array());
  			//$model->check = $_POST['ActiviteitData'];
  			//$modelActiviteitData=new ActiviteitData('datastep2');
  			//$modelActiviteitData->attributes=$_POST['ActiviteitData'];
  			//$modelActiviteitData->eindDatum=$model->attributes["eindDatum"];

  			$model->scenario = 'datastep2';

  			//if(isset($_POST['ActiviteitData'][1]['datum'])){
  				//if($modelActiviteitData->validate('datum')){
				//	echo 'aa';
				//}
				//echo 'bb';
				//print_r($modelActiviteitData);
				//CVarDumper::dump($modelActiviteitData, 10, true);
  				//echo $_POST['ActiviteitData'][1]['datum'];
  			//}

  			
  			// if ( isset( $_POST['ActiviteitData'] ) )
			//{
  			$criteria = new CDbCriteria;
			$criteria->select = 't.datum, t.tijdstip, t.maxInschrijving';
			//$modelActiviteitData=new ActiviteitData;
			$modelActiviteitData = ActiviteitData::model()->find($criteria);
			$model=Evaluation::model()->findAll('evaluation_userID='.$user_id.' AND evaluation_approve=0');
			print_r($modelActiviteitData);
			$valid=true;

			foreach ($modelActiviteitData as $i=>$value) {
				echo $value.'<br>';
				//$a=$i+1;
			//print_r( $value) ;
			//print_r( $_POST['ActiviteitData']);
				if(isset($_POST['ActiviteitData'][$i])){ 
					//echo $i;
					//print_r( $value);
					echo $i.'<br>';
					echo $_POST['ActiviteitData'][$i]['datum'];
					$modelActiviteitData->datum = $_POST['ActiviteitData'][$i]['datum'];
					//$valid=$modelActiviteitData->validate() && $valid;
					$modelActiviteitData->validate();
			//unset($modelActiviteitData->attributes);
				}

			}
            if ($valid){
                // Process CSV
            }
     
        //}
				//$modelActiviteitData->datum[$i]= $_POST['ActiviteitData'][$i]['datum'];
			//print_r( $modelActiviteitData->attributes);
			//$modelActiviteitData->validate();
				//$modelActiviteitData->eindDatum= $model->eindDatum;
				//$modelActiviteitData->datum= $_POST['ActiviteitData'][$i]['datum'];
				//$modelActiviteitData->criteriaName = $criteria[$i];

            	 //if ( ! $modelActiviteitData->validate() )
                	//$foundInvalidChild = true;

				//$modelActiviteitData_array[] = $modelActiviteitData;

				//if(isset($_POST['ActiviteitData'][$i]))
			    	//$modelActiviteitData_array[$i]->attributes =  $_POST['ActiviteitData'][$i];
			   //$valid=$modelActiviteitData_array[$i]->validate() && $valid;
			   // $modelActiviteitData->tijdstip= $dataArray[$i]['tijdstip'];
			   //$modelActiviteitData->validate();
			   //$modelActiviteitData_array[$i] = $modelActiviteitData;
		//	} //CActiveForm::validateTabular($modelActiviteitData_array);//Yii::app()->end(); 
	//	}
			/*$valid=false;
			if($valid){
				$modelActiviteitOptions=new ActiviteitOpties;
				Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);
				//media laden
  				$modelMedia=new Media;
				$this->render('create',array(
					'model'=>$model,
					'modelMedia'=>$modelMedia,
					//'modelActiviteitData'=>$modelActiviteitData,
					'modelActiviteitOptions'=>$modelActiviteitOptions,
					'step'=>'_formStep3'
				));
			}else*/{
				
				$prepopulate = true;
				$this->render('create',array(
					'model'=>$model,
					'modelActiviteitData'=>$modelActiviteitData,
					'step'=>'_formStep2',
					'prepopulate'=> $prepopulate,
				));
			}
		}elseif(/*sset($_POST['ActiviteitOptions']) &&*/ isset($_POST['step4'])){
			
			//Create Step 4 - Content
			//content step -step 4

			$model=new Activiteit;
			$model->datumAangemaakt=date("Y-m-d H:i:s");
			$model->userAangemaakt=Yii::app()->session['personeelsnummer'];
			$model->attributes = Yii::app()->session->get('step1');

			$dataArray = Yii::app()->session->get('step2');

	        $model->save();

	        	$valid=true;
				foreach ($dataArray as $i=>$value) {
					$modelActiviteitData=new ActiviteitData;
					$modelActiviteitData->activiteit_id = $model->id;
				    $modelActiviteitData->attributes= $dataArray[$i];
				    $modelActiviteitData->tijdstip= $dataArray[$i]['tijdstip'];

				    //$valid=$modelActiviteitData->validate() && $valid;
				    //if($valid)
				    	$modelActiviteitData->save();
				}
				$valid=true;
	        	foreach ($_POST['ActiviteitOpties'] as $i=>$value) {
	        		$modelActiviteitOptions=new ActiviteitOpties;
	        		$modelActiviteitOptions->activiteit_id = $model->id;
				    $modelActiviteitOptions->attributes= $_POST['ActiviteitOpties'][$i];
				    //$valid=$modelActiviteitOptions->validate() && $valid;
				    //if($valid)
				    	$modelActiviteitOptions->save();
				}

			//empty session
			Yii::app()->session->remove('step1');
			Yii::app()->session->remove('step2');

  			$model->scenario = 'optionsstep3';
			$this->render('create',array(
							'model'=>$model,
							'modelActiviteitData'=>$modelActiviteitData,
							'modelActiviteitOptions'=>$modelActiviteitOptions,
							'step'=>'_formContent'
						));

			
			/*if ($model->save()){

				$modelActiviteitData=new Model('datastep2');
				$modelActiviteitData->attributes = $this->getPageState('datastep2',array());
				$modelActiviteitData->naamActiviteit = $model->naam;//voor matching activiteit en terugkrijgen ID
				$modelActiviteitData->datumAangemaaktActiviteit = $model->datumAangemaakt;//voor matching activiteit en terugkrijgen ID

				if ($modelActiviteitData->save()){
					$modelActiviteitOptions=new Model('step3');
					$modelActiviteitOptions->attributes = $this->getPageState('step3',array()); // save step3 into form state
					$modelActiviteitOptions->naamActiviteit = $model->naam;//voor matching activiteit en terugkrijgen ID
					$modelActiviteitOptions->datumAangemaaktActiviteit = $model->datumAangemaakt;//voor matching activiteit en terugkrijgen ID

					if ($modelActiviteitOptions->save()){
						$this->renderPartial('create',array(
							'model'=>$model,
							'step'=>'_formContent'
						));
					}
					if($model->save())
				Yii::app()->user->setFlash('success', '<strong>Goed gedaan!</strong> Administrator '.$model->naam.' is succesvol aangepast.');
				$this->redirect(array('view','id'=>$model->id));
				}
			}else{
				Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);
				//media laden
				$modelMedia=new Media;
				$this->render('create',array(
					'model'=>$model,
					'modelMedia'=>$modelMedia,
					'modelActiviteitData'=>$modelActiviteitData,
					'modelActiviteitOptions'=>$modelActiviteitOptions,
					'step'=>'_formStep3'
				));
			}*/
		}else{
			$model=new Activiteit;
			if(isset($_POST['step1']) || isset(Yii::app()->session['step1'])){
				//if step 1 gets posted, for example after clicking back, then all fields should be prepopulated
				//Yii::app()->session->destroy('step2');
				//Yii::app()->session->destroy('step3');
				$model->attributes=Yii::app()->session->get('step1');
				foreach(Yii::app()->session['step1']['groepen'] as $i=>$item){
					$model->groepen[]=Yii::app()->session['step1']['groepen'][$i];
				}
			}
			$this->render('create',array(
				'model'=>$model,
				'step'=>'_form'
			));
		}
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

		if(isset($_POST['Activiteit']))
		{
			$model->attributes=$_POST['Activiteit'];
			if($model->save())
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
		//$dataProvider=new CActiveDataProvider('Activiteit');
		//$this->render('index',array(
			//'dataProvider'=>$dataProvider,
		//));
		// rk - Forward user to action "admin"
        $this->forward('admin'); 
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
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Activiteit::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='activiteit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
