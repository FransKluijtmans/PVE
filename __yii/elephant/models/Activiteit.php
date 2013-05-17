<?php

/**
 * This is the model class for table "activiteit".
 *
 * The followings are the available columns in table 'activiteit':
 * @property integer $id
 * @property string $eindDatum
 * @property integer $aantalData
 * @property integer $aantalOpties
 * @property integer $eigenVervoer
 * @property string $extraUitleg
 * @property string $datumAangemaakt
 * @property integer $secties_id
 * @property integer $geschikt
 * @property string $naam
 * @property string $emailTekst
 * @property integer $content_id
 * @property string $datumAangepast
 * @property string $userAangepast
 * @property string $userAangemaakt
 *
 * The followings are the available model relations:
 * @property Leden[] $ledens
 * @property Leden $userAangepast0
 * @property Leden $userAangemaakt0
 * @property Content $content
 * @property Secties $secties
 * @property ActiviteitData[] $activiteitDatas
 * @property Groepen[] $groepens
 * @property ActiviteitOpties[] $activiteitOpties
 */
class Activiteit extends CActiveRecord
{
	public $groepen;
	public $activiteitDatas;
	public $activiteitOpties;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Activiteit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activiteit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eindDatum, aantalData, aantalOpties, secties_id, naam, groepen', 'required', 'on'=>'step1'),//geschikt,
			//array('datum, tijdstip, maxInschrijving', 'required', 'on'=>'datastep2'),
			array('datumAangemaakt, content_id, userAangemaakt', 'required', 'on'=>'optionsstep3'),
			array('aantalData, aantalOpties, eigenVervoer, secties_id,  content_id', 'numerical', 'integerOnly'=>true),//geschikt,
			array('extraUitleg, emailTekst', 'length', 'max'=>255),
			array('naam', 'length', 'max'=>45),
			array('userAangepast, userAangemaakt', 'length', 'max'=>15),
			array('datumAangepast', 'safe'),
			array('eindDatum', 'type', 'type' => 'date', 'message' => '{attribute} heeft niet het juiste formaat.', 'dateFormat' => 'dd-MM-yyyy'),
			array('eindDatum', 'compareDateRange', 'type' => 'date'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, eindDatum, aantalData, aantalOpties, eigenVervoer, extraUitleg, datumAangemaakt, secties_id, naam, emailTekst, content_id, datumAangepast, userAangepast, userAangemaakt, groepen', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ledens' => array(self::MANY_MANY, 'Leden', 'aanmelding_activiteit(id, leden_personeelsnummer)'),
			'userAangepast0' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'userAangemaakt0' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'content' => array(self::BELONGS_TO, 'Content', 'content_id'),
			'secties' => array(self::BELONGS_TO, 'Secties', 'secties_id'),
			'activiteitDatas' => array(self::HAS_MANY, 'ActiviteitData', 'activiteit_id'),
			'groepen' => array(self::MANY_MANY, 'Groepen', 'activiteit_has_groepen(activiteit_id, groepen_id)'),
			'activiteitOpties' => array(self::HAS_MANY, 'ActiviteitOpties', 'activiteit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'eindDatum' => 'Einddatum inschrijving',
			'aantalData' => 'Aantal data',
			'aantalOpties' => 'Aantal opties',
			'eigenVervoer' => 'Eigen vervoer',
			'extraUitleg' => 'Extra uitleg',
			'datumAangemaakt' => 'Datum aangemaakt',
			'secties_id' => 'Secties',
			'geschikt' => 'Geschikt',
			'naam' => 'Naam',
			'emailTekst' => 'Email tekst',
			'content_id' => 'Content',
			'datumAangepast' => 'Datum aangepast',
			'userAangepast' => 'User aangepast',
			'userAangemaakt' => 'User aangemaakt',
			'groepen' => 'Groepen',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('eindDatum',$this->eindDatum,true);
		$criteria->compare('aantalData',$this->aantalData);
		$criteria->compare('aantalOpties',$this->aantalOpties);
		$criteria->compare('eigenVervoer',$this->eigenVervoer);
		$criteria->compare('extraUitleg',$this->extraUitleg,true);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('secties_id',$this->secties_id);
		$criteria->compare('geschikt',$this->geschikt);
		$criteria->compare('naam',$this->naam,true);
		$criteria->compare('emailTekst',$this->emailTekst,true);
		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		$this->eindDatum = date("Y-m-d", strtotime($this->eindDatum));
		return parent::beforeValidate();
	}
	protected function afterSave()
	{
		if($this->groepen){
			foreach ($this->groepen as $groepId) {
				$activiteitGroep = new ActiviteitHasGroepen;
				$activiteitGroep->activiteit_id = $this->id;
				$activiteitGroep->groepen_id = $groepId;
				if (!$activiteitGroep->save()) print_r($activiteitGroep->errors);
			}
		}

		return parent::afterSave();
	}
	/*
        Validator function to be used from rules() 
    */
	//vergelijk functie. Dat de datum niet voor vandaag ligt
	public function compareDateRange($attribute,$params) {
		if(!empty($this->attributes['eindDatum'])) {
			if(strtotime(date('d-m-Y')) > strtotime(($this->attributes['eindDatum']))) {
				$this->addError($attribute,'De einddatum ligt voor de datum van vandaag.');
			}
		}

	}
}