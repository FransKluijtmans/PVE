<?php

class LedenCspaController extends Controller
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
		$model=new LedenCspa;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['LedenCspa']))
		{
			/*$model->attributes=$_POST['LedenCspa'];
			$model->files=CUploadedFile::getInstance($model,'files');
			if($model->validate()){
				$model->image->saveAs(Yii::app()->basePath . '/files/upload/' . $model->files);
				//$this->redirect(array('admin','id'=>$model->personeelsnummer));
				$this->forward('admin'); 
				Yii::app()->user->setFlash('success', '<strong>Goed gedaan!</strong> Lid is succesvol aangepast.');
				echo 'aaaa';
			}*/
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LedenCspa']))
		{
			$model->attributes=$_POST['LedenCspa'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->personeelsnummer));
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
		/*$dataProvider=new CActiveDataProvider('LedenCspa');
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
		//$model=new LedenCspa('search');
		//$model->unsetAttributes();  // clear any default values
		//if(isset($_GET['LedenCspa']))
			//$model->attributes=$_GET['LedenCspa'];
		$model=new LedenCspa;
		$this->performAjaxValidation($model);

		if(isset($_POST['LedenCspa']))
		{
			$model->attributes=$_POST['LedenCspa'];
			$model->files=CUploadedFile::getInstance($model,'files');
			$model->scenario = 'upload';
			if($model->validate()){

				$model->scenario = 'save';
				$bestandLocatie = Yii::app()->basePath . '/files/upload/' . $model->files;
				$model->files->saveAs($bestandLocatie);
				Yii::import('common.extensions.phpExcelReader.*');
				require('excel_reader2.php');

				$excelRead = new Spreadsheet_Excel_Reader($bestandLocatie,false);
				$highestRow = $excelRead->rowcount($sheet_index=0);
				$highestColumn = $excelRead->colcount($sheet_index=0);

				if($highestColumn <> 13 ){
					Yii::app()->user->setFlash('error', '<strong>Er is iets fout gegaan!</strong> Het aantal kolommen in het Excel bestand is niet correct (13). Pas het bestand aan.');
					unlink($bestandLocatie);
				}else{
					//echo $excelRead->dump(true,true);
					//truncate table
					Yii::app()->db->createCommand('truncate table leden_cspa')->query();

					$notProcessed=array();
					for ($row = 1; $row <= $highestRow; ++ $row) {
						$val=array();
						for ($col = 1; $col < $highestColumn; ++ $col) {
							$cell = $excelRead->val($row,$col,$sheet=0);
							$val[] = $cell;//cleanSQLinput($cell);
						}
						//$model = new Model;
						$model->setIsNewRecord(true);
						$model->setPrimaryKey(NULL);

						$model->personeelsnummer = trim(str_replace ("'", '', $val[0]));
						$model->aanhef = trim($val[1] );
						$model->voorletters = trim($val[2] );
						$model->achternaam = preg_replace('/[^A-Za-z\s-]/', '', $val[3]);
						$model->voorvoegsel = preg_replace('/[^A-Za-z\s-]/', '', $val[4]);
						$model->tweede_achternaam = preg_replace('/[^A-Za-z\s-]/', '', $val[5]);
						$model->tweede_voorvoegsel = preg_replace('/[^A-Za-z\s-]/', '', $val[6]);
						$model->adres = $val[7];
						$model->postcode = str_replace (' ', '', $val[8]);
						$model->plaats = ucfirst(strtolower(str_replace('`', "'", $val[9])));
						$model->geboortedatum = date("Y-m-d", strtotime(str_replace('.', '-', $val[10] )));
						$model->bijdrage = trim(preg_replace('/[^0-9,.]/', '', $val[11] ));//strip alles behalve cijfers en comma;

						if($model->save()){
							//do something
						}else{
							unset($errorsArray);
							$errorsArray = '';
							unset($errors);
							$errors = '';
							 if(array_key_exists('postcode', $model->getErrors() )){
					        	$errorsArray =  $model->getErrors('postcode');
					        	foreach($errorsArray as $val){
									$errors .= $val . PHP_EOL;
								}
					        }elseif(array_key_exists('plaats', $model->getErrors() )){
					        	$errorsArray =  $model->getErrors('plaats');
					        	foreach($errorsArray as $val){
									$errors .= $val . PHP_EOL;
								}
					    	}elseif(array_key_exists('adres', $model->getErrors() )){
					        	$errorsArray =  $model->getErrors('adres');
					        	foreach($errorsArray as $val){
									$errors .= $val . PHP_EOL;
								}
							}elseif(array_key_exists('achternaam', $model->getErrors() )){
					        	$errorsArray =  $model->getErrors('achternaam');
					        	foreach($errorsArray as $val){
									$errors .= $val . PHP_EOL;
								}
							}
							$fileNotProccesed = Yii::app()->basePath . '/files/upload/notprocessed.txt';
							if (!file_exists($fileNotProccesed)){
								fopen($fileNotProccesed, 'a');
							}
							$writefile = file_get_contents($fileNotProccesed);
							$writefile .= $model->personeelsnummer.' - '.$model->aanhef.' '.$model->voorletters.' '.$model->voorvoegsel.' '.$model->achternaam.' '.$model->tweede_voorvoegsel.' '.$model->tweede_achternaam.' - '. $errors;
							file_put_contents($fileNotProccesed, $writefile);
							//$notProcessed[] = print_r($model->getErrors());
							//print_r ($model->getErrors());
							//delete lid uit cspa tabel
							if($modelLeden->save()){
		            			//echo 'personeelsnummer is '.$key.' en naam is '.$value.' '.$modelLeden->straat.'-'.$modelLeden->huisNummer.'-'.$modelLeden->toevoeging.'--'.$modelLeden->groepens;
		            			LedenCspa::model()->deleteAll('personeelsnummer= "'.$key.'"');
		            			$teller++;
		            		}
						}
						Yii::app()->user->setFlash('succes', '<strong>Er is iets fout gegaan!</strong> Het aantal kolommen in het Excel bestand is niet correct (13). Pas het bestand aan.');
					}
					//$succesResponse = "<ul><li class='klant_melding'>Het bestand ".$worksheetTitle." bestaat uit ". $highestRow ." leden. Deze zijn allemaal geimporteerd. </li></ul>";
					//print_r($notProcessed);
					Yii::app()->user->setFlash('succes', '<strong>Er is iets fout gegaan!</strong> Het aantal kolommen in het Excel bestand is niet correct (13). Pas het bestand aan.');
				}
				//$this->redirect(array('admin','id'=>$model->personeelsnummer));
				//$this->forward('admin'); 
				
				
			}
		}

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
		$model=LedenCspa::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModelLeden($id)
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='leden-cspa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function getStats($id)
	{
		//check of de table gevuld is.
		$countRows = LedenCspa::Model()->count("personeelsnummer");
		if($countRows == 0){
			$result = 0;
			return $result;
		}else{
			if($id == 'newmembers'){
				$result = Yii::app()->db->createCommand()
				    ->select('count(DISTINCT leden_cspa.personeelsnummer) as num' )
				    ->from('leden_cspa')
				    ->leftJoin('leden', 'leden.personeelsnummer=leden_cspa.personeelsnummer')
				    ->where('leden_cspa.bijdrage <> "" AND leden.personeelsnummer IS NULL')
				    ->queryRow();
				return $result['num'];
			}elseif($id == 'newpersonel'){
				$result = Yii::app()->db->createCommand()
				    ->select('count(DISTINCT leden_cspa.personeelsnummer) as num' )
				    ->from('leden_cspa')
				    ->leftJoin('leden', 'leden_cspa.personeelsnummer=leden.personeelsnummer')
				    ->where('leden_cspa.bijdrage = "" AND leden.personeelsnummer IS NULL')
				    ->queryRow();
				return $result['num'];
			}elseif($id == 'leavingmembers'){
				$result = Yii::app()->db->createCommand()
				    ->select('count(DISTINCT leden.personeelsnummer) as num' )
				    ->from('leden')
				    ->leftJoin('leden_cspa', 'leden_cspa.personeelsnummer=leden.personeelsnummer')
				    ->where('leden.werkendLid <> 0')
				    ->queryRow();
				return $result['num'];
			}elseif($id == 'notvalidatedcspa'){
				$file= Yii::app()->basePath . '/files/upload/notprocessed.txt';
				$linecount = 0;
				$handle = fopen($file, "r");
				while(!feof($handle)){
				  $line = fgets($handle);
				  $linecount = $linecount + substr_count($line, PHP_EOL);
				}

				fclose($handle);
				return $linecount;
			}
		}		
	}/*
	<?php 
			$sql="	SELECT count(*) FROM tbl_leden_cspa LIMIT 1";
			$result = mysql_query($sql) or die (mysql_error());
			$num=mysql_numrows($result);
			
			if($num > 0) : 
				$sql_nieuwLeden="SELECT count(DISTINCT tbl_leden_cspa.personeelsnummer) as num FROM tbl_leden_cspa WHERE NOT EXISTS (SELECT tbl_leden.personeelsnummer FROM tbl_leden WHERE tbl_leden.personeelsnummer = tbl_leden_cspa.personeelsnummer) AND tbl_leden_cspa.bijdrage <> '' ";
				//Run your mysql_query
				$result_nieuwLeden = mysql_query($sql_nieuwLeden) or die (mysql_error());
				$num_nieuwLeden=mysql_fetch_array($result_nieuwLeden);
				
				$sql_nieuwMedewerkers="SELECT count(DISTINCT tbl_leden_cspa.personeelsnummer) as num FROM tbl_leden_cspa WHERE NOT EXISTS (SELECT * FROM tbl_leden WHERE tbl_leden.personeelsnummer = tbl_leden_cspa.personeelsnummer) AND tbl_leden_cspa.bijdrage = '' ";
				//Run your mysql_query
				$result_nieuwMedewerkers = mysql_query($sql_nieuwMedewerkers) or die (mysql_error());
				$num_nieuwMedewerkers=mysql_fetch_array($result_nieuwMedewerkers);
				
				$sql_vertrokkenLeden="SELECT count(DISTINCT tbl_leden.personeelsnummer) as num FROM tbl_leden WHERE NOT EXISTS (SELECT * FROM tbl_leden_cspa WHERE tbl_leden.personeelsnummer = tbl_leden_cspa.personeelsnummer) AND werkend_lid <> 2";
				
				//Run your mysql_query
				$result_vertrokkenLeden = mysql_query($sql_vertrokkenLeden) or die (mysql_error());
				$num_vertrokkenLeden=mysql_fetch_array($result_vertrokkenLeden);
			?>*/
	public function actionNewmembers()
	{
	    $model=new LedenCspa('new');

	    $count=Yii::app()->db->createCommand('	SELECT COUNT(DISTINCT leden_cspa.personeelsnummer) 
	    										FROM leden_cspa 
	    										LEFT JOIN leden
	    										ON leden_cspa.personeelsnummer=leden.personeelsnummer 
	    										WHERE leden_cspa.bijdrage <> "" AND leden.personeelsnummer IS NULL' )->queryScalar();
		$sql='	SELECT leden_cspa.personeelsnummer, leden_cspa.aanhef, leden_cspa.voorletters, leden_cspa.achternaam,leden_cspa.voorvoegsel,leden_cspa.tweede_voorvoegsel,leden_cspa.tweede_achternaam 
				FROM leden_cspa 
				LEFT JOIN leden
				ON leden_cspa.personeelsnummer=leden.personeelsnummer 
				WHERE leden_cspa.bijdrage <> "" AND leden.personeelsnummer IS NULL';
		$dataProvider=new CSqlDataProvider($sql, array(
		    'totalItemCount'=>$count,
		    'sort'=>array(
		        'attributes'=>array(
		             'personeelsnummer', 'aanhef', 'voorletters','achternaam','voorvoegsel','tweede_voorvoegsel','tweede_achternaam'
		        ),
		    ),

		    'pagination'=>array(
		        'pageSize'=>50,
		    ),
		));
	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='leden-cspa-newmembers-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

	    if(isset($_POST['LedenCspa']))
	    {
	        $model->attributes=$_POST['LedenCspa'];
	        if($model->validate())
	        {
	        	//check of er radiobuttons zijn geselecteerd
	        	if (isset($_POST['pv']))
		        {
		        	$teller = 0;
		        	//uitlezen van de geselecteerd array pve/pvu
		            foreach ($_POST['pv']  as $key => $value) {
		            	$LedenCspa = LedenCspa::model()->find('personeelsnummer = '.$key);
		            	//opslaan in de leden tabel.
		            	$modelLeden=new Leden;
		            	//$modelLeden->attributes=$_POST['LedenCspa'];
		            	$modelLeden->personeelsnummer = $key;
		            	$modelLeden->aanhef = $LedenCspa->aanhef;
		            	$modelLeden->voorletters = $LedenCspa->voorletters;
		            	$modelLeden->achternaam = $LedenCspa->achternaam.' '.$LedenCspa->tweede_voorvoegsel.' '.$LedenCspa->tweede_achternaam;
		            	$modelLeden->voorvoegsel = $LedenCspa->voorvoegsel;
		            	$modelLeden->huisNummer = str_replace('-', '', filter_var($LedenCspa->adres, FILTER_SANITIZE_NUMBER_INT));
		            	
		            	//positie bepalen van laatste getal
		            	preg_match('/\d/', $LedenCspa->adres, $matches, PREG_OFFSET_CAPTURE);
		            	//pregmatch = laatste getal opzoeken
		            	//substr = zoeken naar toevoeging na laatste getal. $matches[0][1] = laatste getal, strlen($modelLeden->huisNummer) = lengte laatste getal, die twee optellen = toevoeging
		            	//trim = spaties weghalen
		            	$modelLeden->toevoeging = trim(substr($LedenCspa->adres, $matches[0][1]+strlen($modelLeden->huisNummer)));
		            	if($modelLeden->toevoeging == ''){
		            		$huisnummer = ' '.$modelLeden->huisNummer.''.$modelLeden->toevoeging; 
		            	}else{
							$huisnummer = ' '.$modelLeden->huisNummer.' '.$modelLeden->toevoeging; 
		            	}
		            	$modelLeden->straat = str_replace($huisnummer, '', $LedenCspa->adres);
		            	$modelLeden->postcode = $LedenCspa->postcode;
		            	$modelLeden->plaats = $LedenCspa->plaats;
		            	$modelLeden->geboorteDatum = $LedenCspa->geboortedatum;
		            	//check welke groep het nieuwe lid bij hoort.
		            	$LedenGroepen = Groepen::model()->find('naam = "'.strtoupper($value).'"');
						$modelLeden->groepens= $LedenGroepen->id;
						$modelLeden->datumAangemaakt=date("Y-m-d H:i:s");
						$modelLeden->userAangemaakt=Yii::app()->session['personeelsnummer'];
						if($modelLeden->save()){
		            		//echo 'personeelsnummer is '.$key.' en naam is '.$value.' '.$modelLeden->straat.'-'.$modelLeden->huisNummer.'-'.$modelLeden->toevoeging.'--'.$modelLeden->groepens;
		            		LedenCspa::model()->deleteAll('personeelsnummer= "'.$key.'"');
		            		$teller++;
		            		Yii::app()->user->setFlash('success', '<strong>Goed gedaan!</strong> Er zijn '.$teller.' nieuwe leden succesvol aangemaakt.');
		            	}else{
		            		print_r($modelLeden->getErrors());
		            	}
		            	//print_r($modelLeden->getErrors());
		            }
		            
		            //$dataProvider=new CActiveDataProvider('LedenCspa');
		            $this->render('newmembers',array('model'=>$model, 'dataProvider'=>$dataProvider,));
		        }

	            return;
	        }
	    }
	    //$dataProvider=new CActiveDataProvider('LedenCspa');
	    $this->render('newmembers',array('model'=>$model, 'dataProvider'=>$dataProvider,));
	}
	
	public function actionNewpersonel()
	{
	    $model=new LedenCspa('new');

	    $count=Yii::app()->db->createCommand('	SELECT COUNT(DISTINCT leden_cspa.personeelsnummer) 
	    										FROM leden_cspa 
	    										LEFT JOIN leden 
	    										ON leden_cspa.personeelsnummer=leden.personeelsnummer
	    										WHERE leden_cspa.bijdrage = "" AND leden.personeelsnummer IS NULL' )->queryScalar();
		$sql='	SELECT leden_cspa.personeelsnummer, leden_cspa.aanhef, leden_cspa.voorletters, leden_cspa.achternaam,leden_cspa.voorvoegsel,leden_cspa.tweede_voorvoegsel,leden_cspa.tweede_achternaam 
				FROM leden_cspa 
				LEFT JOIN leden
				ON leden_cspa.personeelsnummer=leden.personeelsnummer 
				WHERE leden_cspa.bijdrage = "" AND leden.personeelsnummer IS NULL';
		$dataProvider=new CSqlDataProvider($sql, array(
		    'totalItemCount'=>$count,
		    'sort'=>array(
		        'attributes'=>array(
		             'personeelsnummer', 'aanhef', 'voorletters','achternaam','voorvoegsel','tweede_voorvoegsel','tweede_achternaam'
		        ),
		    ),

		    'pagination'=>array(
		        'pageSize'=>50,
		    ),
		));
	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='leden-cspa-newmembers-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

	    if(isset($_POST['LedenCspa']))
	    {
	        $model->attributes=$_POST['LedenCspa'];
	        if($model->validate())
	        {
	        	//check of er radiobuttons zijn geselecteerd
	        	if (isset($_POST['checkRow']))
		        {
		        	$teller = 0;

		        	//uitlezen van de geselecteerd array pve/pvu
		            foreach ($_POST['checkRow']  as $key => $value) {
		            	//echo $key.'-'.$value.'-'.Yii::app()->user->setState($value,0).'<br/>';
		            	
		            	$LedenCspa = LedenCspa::model()->find('personeelsnummer = '.$key);
		            	//opslaan in de leden tabel.
		            	$modelLeden=new Leden;
		            	//$modelLeden->attributes=$_POST['LedenCspa'];
		            	$modelLeden->personeelsnummer = $key;
		            	$modelLeden->aanhef = $LedenCspa->aanhef;
		            	$modelLeden->voorletters = $LedenCspa->voorletters;
		            	$modelLeden->achternaam = $LedenCspa->achternaam.' '.$LedenCspa->tweede_voorvoegsel.' '.$LedenCspa->tweede_achternaam;
		            	$modelLeden->voorvoegsel = $LedenCspa->voorvoegsel;
		            	$modelLeden->huisNummer = str_replace('-', '', filter_var($LedenCspa->adres, FILTER_SANITIZE_NUMBER_INT));
		            	
		            	//positie bepalen van laatste getal
		            	preg_match('/\d/', $LedenCspa->adres, $matches, PREG_OFFSET_CAPTURE);
		            	//pregmatch = laatste getal opzoeken
		            	//substr = zoeken naar toevoeging na laatste getal. $matches[0][1] = laatste getal, strlen($modelLeden->huisNummer) = lengte laatste getal, die twee optellen = toevoeging
		            	//trim = spaties weghalen
		            	$modelLeden->toevoeging = trim(substr($LedenCspa->adres, $matches[0][1]+strlen($modelLeden->huisNummer)));
		            	if($modelLeden->toevoeging == ''){
		            		$huisnummer = ' '.$modelLeden->huisNummer.''.$modelLeden->toevoeging; 
		            	}else{
							$huisnummer = ' '.$modelLeden->huisNummer.' '.$modelLeden->toevoeging; 
		            	}
		            	$modelLeden->straat = str_replace($huisnummer, '', $LedenCspa->adres);
		            	$modelLeden->postcode = $LedenCspa->postcode;
		            	$modelLeden->plaats = $LedenCspa->plaats;
		            	$modelLeden->geboorteDatum = $LedenCspa->geboortedatum;
		            	//check welke groep het nieuwe lid bij hoort.
		            	//$LedenGroepen = Groepen::model()->find('naam = "'.strtoupper($value).'"');
						$modelLeden->groepens= null;
						$modelLeden->datumAangemaakt=date("Y-m-d H:i:s");
						$modelLeden->userAangemaakt=Yii::app()->session['personeelsnummer'];
						if($modelLeden->save()){
		            		//echo 'personeelsnummer is '.$key.' en naam is '.$value.' '.$modelLeden->straat.'-'.$modelLeden->huisNummer.'-'.$modelLeden->toevoeging.'--'.$modelLeden->groepens;
		            		LedenCspa::model()->deleteAll('personeelsnummer= "'.$key.'"');
		            		$teller++;
							Yii::app()->user->setFlash('success', '<strong>Goed gedaan!</strong> Er zijn '.$teller.' nieuwe leden succesvol aangemaakt.');
		            	}else{
		            		//print_r($modelLeden->getErrors());
		            		$errors = $modelLeden->getErrors();

							$out='';
							foreach($errors as $key=>$erText){
								$out.= '<br /><b>'.$key.'</b>: '.$erText[0];
							}
		            		Yii::app()->user->setFlash('error', '<strong>Er is iets niet goed gegaan!</strong> '.$out);
		            	}
		            	//print_r($modelLeden->getErrors());
		            	
		            }
		           
		            //$dataProvider=new CActiveDataProvider('LedenCspa');
		            $this->render('newpersonel',array('model'=>$model, 'dataProvider'=>$dataProvider,));
		        }

	            return;
	        }
	    }
	    //$dataProvider=new CActiveDataProvider('LedenCspa');
	    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);
	    $this->render('newpersonel',array('model'=>$model, 'dataProvider'=>$dataProvider,));
	}

	public function actionLeavingmembers()
	{
	    $model=new LedenCspa('new');

	    $count=Yii::app()->db->createCommand('	SELECT COUNT(DISTINCT leden.personeelsnummer) 
	    										FROM leden
	    										LEFT JOIN leden_cspa 
	    										ON leden.personeelsnummer=leden_cspa.personeelsnummer
	    										WHERE leden.werkendLid <> 0' )->queryScalar();
		$sql='	SELECT leden.personeelsnummer, leden.aanhef, leden.voorletters, leden.achternaam,leden.voorvoegsel
				FROM leden
				LEFT JOIN leden_cspa
				ON leden_cspa.personeelsnummer=leden.personeelsnummer 
				WHERE leden.werkendLid <> 0';
		$dataProvider=new CSqlDataProvider($sql, array(
		    'totalItemCount'=>$count,
		    'sort'=>array(
		        'attributes'=>array(
		             'personeelsnummer', 'aanhef', 'voorletters','achternaam','voorvoegsel'
		        ),
		    ),

		    'pagination'=>array(
		        'pageSize'=>50,
		    ),
		));
	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='leden-cspa-newmembers-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

	    if(isset($_POST['LedenCspa']))
	    {
	        $model->attributes=$_POST['LedenCspa'];
	        //if($model->validate())
	        //{
	        	//check of er radiobuttons zijn geselecteerd
	        	if (isset($_POST['checkRow']))
		        {
		        	$teller = 0;

		        	//uitlezen van de geselecteerd array pve/pvu
		            foreach ($_POST['checkRow']  as $key => $value) {
		            	//echo $key.'-'.$value.'-'.Yii::app()->user->setState($value,0).'<br/>';
		            	//$model->findByPk($key);

						if($this->loadModelLeden($key)->delete()){
		            		//echo 'personeelsnummer is '.$key.' en naam is '.$value.' '.$modelLeden->straat.'-'.$modelLeden->huisNummer.'-'.$modelLeden->toevoeging.'--'.$modelLeden->groepens;
		            		$teller++;
							Yii::app()->user->setFlash('success', '<strong>Goed gedaan!</strong> Lid met personeelsnummer '.$key.' is succesvol verwijderd.');
		            	}else{
		            		//print_r($modelLeden->getErrors());
		            		//$errors = $modelLeden->getErrors();

							//$out='';
							//foreach($errors as $key=>$erText){
							//	$out.= '<br /><b>'.$key.'</b>: '.$erText[0];
							//}
		            		Yii::app()->user->setFlash('error', '<strong>Er is iets niet goed gegaan!</strong>');
		            	}
		            	//print_r($modelLeden->getErrors());
		            	
		            }
		           
		            //$dataProvider=new CActiveDataProvider('LedenCspa');
		            $this->render('leavingmembers',array('model'=>$model, 'dataProvider'=>$dataProvider,));
		        }

	            return;
	        //}
	    }
	    //$dataProvider=new CActiveDataProvider('LedenCspa');
	    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/mainFunctions.js',CClientScript::POS_END);
	    $this->render('leavingmembers',array('model'=>$model, 'dataProvider'=>$dataProvider,));
	}

	public function actionNotvalidatedcspa()
	{
		$fileNotProccesed = Yii::app()->basePath . '/files/upload/notprocessed.txt';
		$data = file($fileNotProccesed) or die('Could not read file!'); 
		$lines = '<table class="items table table-striped table-condensed">
					<thead>
						<tr>
							<th>Personeelsnummer</th>
							<th>Naam</th>
							<th>Foutmelding</th>
						</tr>
					</thead>
					<tbody>';
		$rowColor = 'odd';
		foreach ($data as $line)
		{
			//extract the variables
			list($personeelsnummer, $naam, $foutmelding)=explode("-",$line);
			//$lines .= $line.'<br/>';
			$lines .= '<tr class="'.$rowColor.'"><td>'.$personeelsnummer.'</td><td>'.$naam.'</td><td>'.$foutmelding.'</td></tr>';
			if($rowColor == 'odd'){
				$rowColor = 'even';
			}elseif($rowColor == 'even'){
				$rowColor = 'odd';
			}
		}
		$lines .= '</tbody></table>';
		$this->render('notvalidatedcspa',array(
			'lines'=>$lines,
		));
	}
	
}

