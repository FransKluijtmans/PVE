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
			array('eindDatum, aantalData, aantalOpties, datumAangemaakt, secties_id, naam, content_id, userAangemaakt', 'required'),
			array('aantalData, aantalOpties, eigenVervoer, secties_id, geschikt, content_id', 'numerical', 'integerOnly'=>true),
			array('extraUitleg, emailTekst', 'length', 'max'=>255),
			array('naam', 'length', 'max'=>45),
			array('userAangepast, userAangemaakt', 'length', 'max'=>15),
			array('datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, eindDatum, aantalData, aantalOpties, eigenVervoer, extraUitleg, datumAangemaakt, secties_id, geschikt, naam, emailTekst, content_id, datumAangepast, userAangepast, userAangemaakt', 'safe', 'on'=>'search'),
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
			'groepens' => array(self::MANY_MANY, 'Groepen', 'activiteit_has_groepen(activiteit_id, groepen_id)'),
			'activiteitOpties' => array(self::HAS_MANY, 'ActiviteitOpties', 'activiteit_id'),
			'aanmeldingActiviteit' => array(self::HAS_MANY, 'AanmeldingActiviteit', 'id'),
			//relation with base table exsists through activiteit_opties  
			'aanmeldingActiviteitHasActiviteitOpties'=>array(
                self::HAS_MANY,'AanmeldingActiviteitHasActiviteitOpties',array('id'=>'activiteit_opties_id'),'through'=>'activiteitOpties'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'eindDatum' => 'Eind Datum',
			'aantalData' => 'Aantal Data',
			'aantalOpties' => 'Aantal Opties',
			'eigenVervoer' => 'Eigen Vervoer',
			'extraUitleg' => 'Extra Uitleg',
			'datumAangemaakt' => 'Datum Aangemaakt',
			'secties_id' => 'Secties',
			'geschikt' => 'Geschikt',
			'naam' => 'Naam',
			'emailTekst' => 'Email Tekst',
			'content_id' => 'Content',
			'datumAangepast' => 'Datum Aangepast',
			'userAangepast' => 'User Aangepast',
			'userAangemaakt' => 'User Aangemaakt',
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
}