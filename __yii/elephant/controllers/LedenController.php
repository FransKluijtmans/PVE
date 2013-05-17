<?php

class LedenController extends Controller
{
	const API_TIMEOUT = 3;
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
				'actions'=>array('login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','admin','delete', 'updateAdres'),
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
		$model=new Leden;
		$model->scenario = 'createLeden';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Leden']))
		{
			$model->attributes=$_POST['Leden'];
			$model->geboorteDag=$_POST['Leden']['geboorteDag'];
			$model->geboorteMaand=$_POST['Leden']['geboorteMaand'];
			$model->geboorteJaar=$_POST['Leden']['geboorteJaar'];
			$model->groepens=$_POST['Leden']['groepens'];
			$model->datumAangemaakt=date("Y-m-d H:i:s");
			$model->userAangemaakt=Yii::app()->session['personeelsnummer'];
			if($model->save())

	            /*foreach ($_POST['Leden']['groepens'] as $groepId) {
	                $lidGroep = new LedenHasGroepen;
	                $lidGroep->leden_personeelsnummer = $model->personeelsnummer;
	                $lidGroep->groepen_id = $groepId;
	                if (!$lidGroep->save()) print_r($lidGroep->errors);
	            }*/
	           // Yii::app()->user->setFlash('success', '<strong>Goed gedaan!</strong> Lid '.$model->voorletters.' '.$model->voorvoegsel.' '.$model->achternaam.' is succesvol aangemaakt.');
				$this->redirect(array('view','id'=>$model->personeelsnummer));
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
		$model->scenario = 'updateLeden';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Leden']))
		{
			$model->attributes=$_POST['Leden'];
			$model->geboorteDag=$_POST['Leden']['geboorteDag'];
			$model->geboorteMaand=$_POST['Leden']['geboorteMaand'];
			$model->geboorteJaar=$_POST['Leden']['geboorteJaar'];
			$model->groepens=$_POST['Leden']['groepens'];
			$model->datumAangepast=date("Y-m-d H:i:s");
			$model->userAangepast=Yii::app()->session['personeelsnummer'];
			if($model->save()){
				Yii::app()->user->setFlash('success', '<strong>Goed gedaan!</strong> Lid '.$model->voorletters.' '.$model->voorvoegsel.' '.$model->achternaam.' is succesvol aangepast.');
				$this->redirect(array('view','id'=>$model->personeelsnummer));
			}
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
			if(!isset($_GET['ajax']))
				Yii::app()->user->setFlash('success','<strong>Goed gedaan!</strong> Het record is succesvol verwijderd.');
			else
				echo "<div class='alert in alert-block fade alert-success'><a class='close' data-dismiss='alert'>&times;</a><strong>Goed gedaan!</strong> Het record is succesvol verwijderd.</div>";
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
		/*$dataProvider=new CActiveDataProvider('Leden');
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
		$model=new Leden('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Leden']))
			$model->attributes=$_GET['Leden'];

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
		$model=Leden::model()->findByPk($id);
		//nodig voor het vullen van de groepen checkbox - http://www.larryullman.com/2010/08/10/handling-related-models-in-yii-forms/
		$criteria=new CDbCriteria;
		$criteria->condition='leden_personeelsnummer=:personeelsnummer';
		$criteria->select = 'groepen_id';
		$criteria->params=array(':personeelsnummer'=>$_GET['id']);
		$lidGroepen = LedenHasGroepen::model()->findAll($criteria);

		$groepen = array();
		foreach ($lidGroepen as $groep) {
		    $groepen[] = $groep->groepen_id;
		}

		$model->groepens = $groepen;
		//groepencheckbox
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='leden-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Return streetadress and city names
	 * https://api.postcode.nl/rest/addresses/<postcode>/<housenr>(/<housnrAddition>) 
	 */
	public function actionUpdateAdres()
	{
		if(Yii::app()->request->isAjaxRequest)
            {
			$serviceUrl = "https://api.postcode.nl/rest/addresses/"; //trim(Mage::getStoreConfig('postcodenl/config/api_url'));
			$serviceKey = "fLtyK0HiiJGG9dz0SUU2cQiGyfZhcckR8Nk9SBab1Dz"; //trim(Mage::getStoreConfig('postcodenl/config/api_key'));
			$serviceSecret = "Sc5RmrssAzz7iZ8em764CClrM0E92ulWIfMJlBCmg03"; //trim(Mage::getStoreConfig('postcodenl/config/api_secret'));
			/*
			//$serviceShowcase = Mage::getStoreConfig('postcodenl/config/api_showcase');
			//$serviceDebug = Mage::getStoreConfig('postcodenl/config/api_debug');

			//$extensionInfo = $this->_getModuleInfo('PostcodeNl_Api');
			//$extensionVersion = $extensionInfo ? (string)$extensionInfo->version : 'unknown';

			if (!$serviceUrl || !$serviceKey || !$serviceSecret)
			{
				echo json_encode(array('message' => $this->__('Postcode.nl API not configured.')));
				return;
			}

//curl https://api.postcode.nl/rest/addresses/5612ga/17 -d “username=fLtyK0HiiJGG9dz0SUU2cQiGyfZhcckR8Nk9SBab1Dz” -d “password=Sc5RmrssAzz7iZ8em764CClrM0E92ulWIfMJlBCmg03”
			//$url = $serviceUrl . urlencode($_REQUEST['postcode']). '/'. urlencode($_REQUEST['houseNumber']) . '/'. urlencode($_REQUEST['houseNumberAddition']);
			$url = 'https://api.postcode.nl/rest/addresses/5612ga/17';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::API_TIMEOUT);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($ch, CURLOPT_USERPWD, $serviceKey .':'. $serviceSecret);
			curl_setopt($ch, CURLOPT_USERAGENT, 'personeelsvereniging-eindhoven.nl');
			$jsonResponse = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($jsonResponse, true);


			
			$sendResponse = array();
			if ($serviceShowcase)
				$sendResponse['showcaseResponse'] = $response;

			if ($serviceDebug)
			{
				$modules = array();
				foreach (Mage::getConfig()->getNode('modules')->children() as $name => $module)
				{
					$modules[$name] = array();
					foreach ($module as $key => $value)
					{
						if (in_array((string)$key, array('active')))
							$modules[$name][$key] = (string)$value == 'true' ? true : false;
						else if (in_array((string)$key, array('codePool', 'version')))
							$modules[$name][$key] = (string)$value;
					}
				}

				$sendResponse['debugInfo'] = array(
					'requestUrl' => $url,
					'rawResponse' => $jsonResponse,
					'parsedResponse' => $response,
					'curlError' => curl_error($ch),
					'configuration' => array(
						'url' => $serviceUrl,
						'key' => $serviceKey,
						'secret' => substr($serviceSecret, 0, 6) .'[hidden]',
						'showcase' => $serviceShowcase,
						'debug' => $serviceDebug,
					),
					'magentoVersion' => $this->_getMagentoVersion(),
					'extensionVersion' => $extensionVersion,
					'modules' => $modules,
				);
			} 

			if (is_array($response) && isset($response['exceptionId']))
			{
				switch ($response['exceptionId'])
				{
					case 'PostcodeNl_Controller_Address_InvalidPostcodeException':
						$sendResponse['message'] = $this->__('Invalid postcode format, use `1234AB` format.');
						$sendResponse['messageTarget'] = 'postcode';
						break;
					case 'PostcodeNl_Service_PostcodeAddress_AddressNotFoundException':
						$sendResponse['message'] = $this->__('Unknown postcode + housenumber combination.');
						$sendResponse['messageTarget'] = 'housenumber';
						break;
					default:
						$sendResponse['message'] = $this->__('Validation error, please use manual input.');
						$sendResponse['messageTarget'] = 'housenumber';
						break;
				}
			}
			else if (is_array($response) && isset($response['postcode']))
			{
				$sendResponse = array_merge($sendResponse, $response);
			}
			else
			{
				$sendResponse['message'] = $this->__('Validation unavailable, please use manual input.');
				$sendResponse['messageTarget'] = 'housenumber';
			}*/


			$url = $serviceUrl . urlencode($_POST['Leden']["postcode"]). '/'. urlencode($_POST['Leden']['huisNummer']) . '/'. urlencode($_POST['Leden']['toevoeging']);
			$context = stream_context_create(array(
			    'http' => array(
			        'header'  => "Authorization: Basic " . base64_encode("$serviceKey:$serviceSecret"),
			        'timeout' => 10 // 10 sec
			    )
			));
			$data = @file_get_contents($url, false, $context);
			if (!$data) {
				header('Content-type: application/json');
			    echo ('{"status" : "nok"}');
			} else {
				header('Content-type: application/json');
			    echo ($data);
			}
			
			Yii::app()->end();
		}
	}
	//autocomplete
	public function actionAutocompleteLastname() {
		$res =array();

		if (isset($_GET['term'])) {
			// http://www.yiiframework.com/doc/guide/database.dao
			$qtxt ="SELECT achternaam FROM leden WHERE achternaam LIKE :achternaam";
			$command =Yii::app()->db->createCommand($qtxt);
			$command->bindValue(":achternaam", '%'.$_GET['term'].'%', PDO::PARAM_STR);
			$res =$command->queryColumn();
		}

		echo CJSON::encode($res);
		Yii::app()->end();
	}
}