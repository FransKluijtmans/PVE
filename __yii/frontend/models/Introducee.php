<?php

/**
 * This is the model class for table "introducee".
 *
 * The followings are the available columns in table 'introducee':
 * @property string $id
 * @property string $aanhef
 * @property string $voorletters
 * @property string $achternaam
 * @property string $voorvoegsel
 * @property string $emailAdres
 * @property string $straat
 * @property string $huisNummer
 * @property string $toevoeging
 * @property string $postcode
 * @property string $plaats
 * @property string $geboorteDatum
 * @property integer $telefoonNummer
 * @property string $leden_personeelsnummer
 * @property string $datumAangemaakt
 * @property string $datumAangepast
 * @property string $userAangemaakt
 * @property string $userAangepast
 *
 * The followings are the available model relations:
 * @property AanmeldingActiviteitHasActiviteitOpties[] $aanmeldingActiviteitHasActiviteitOpties
 * @property Leden $userAangemaakt0
 * @property Leden $userAangepast0
 * @property Leden $ledenPersoneelsnummer
 */
class Introducee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Introducee the static model class
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
		return 'introducee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('voorletters, achternaam, leden_personeelsnummer, datumAangemaakt, userAangemaakt', 'required'),
			array('telefoonNummer', 'numerical', 'integerOnly'=>true),
			array('aanhef', 'length', 'max'=>5),
			array('voorletters, achternaam, emailAdres', 'length', 'max'=>45),
			array('voorvoegsel', 'length', 'max'=>10),
			array('straat', 'length', 'max'=>100),
			array('huisNummer', 'length', 'max'=>4),
			array('toevoeging', 'length', 'max'=>2),
			array('postcode', 'length', 'max'=>6),
			array('plaats', 'length', 'max'=>255),
			array('leden_personeelsnummer, userAangemaakt, userAangepast', 'length', 'max'=>15),
			array('geboorteDatum, datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, aanhef, voorletters, achternaam, voorvoegsel, emailAdres, straat, huisNummer, toevoeging, postcode, plaats, geboorteDatum, telefoonNummer, leden_personeelsnummer, datumAangemaakt, datumAangepast, userAangemaakt, userAangepast', 'safe', 'on'=>'search'),
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
			'aanmeldingActiviteitHasActiviteitOpties' => array(self::HAS_MANY, 'AanmeldingActiviteitHasActiviteitOpties', 'deelnemer'),
			'userAangemaakt0' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'userAangepast0' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'ledenPersoneelsnummer' => array(self::BELONGS_TO, 'Leden', 'leden_personeelsnummer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'aanhef' => 'Aanhef',
			'voorletters' => 'Voorletters',
			'achternaam' => 'Achternaam',
			'voorvoegsel' => 'Voorvoegsel',
			'emailAdres' => 'Email Adres',
			'straat' => 'Straat',
			'huisNummer' => 'Huis Nummer',
			'toevoeging' => 'Toevoeging',
			'postcode' => 'Postcode',
			'plaats' => 'Plaats',
			'geboorteDatum' => 'Geboorte Datum',
			'telefoonNummer' => 'Telefoon Nummer',
			'leden_personeelsnummer' => 'Leden Personeelsnummer',
			'datumAangemaakt' => 'Datum Aangemaakt',
			'datumAangepast' => 'Datum Aangepast',
			'userAangemaakt' => 'User Aangemaakt',
			'userAangepast' => 'User Aangepast',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('aanhef',$this->aanhef,true);
		$criteria->compare('voorletters',$this->voorletters,true);
		$criteria->compare('achternaam',$this->achternaam,true);
		$criteria->compare('voorvoegsel',$this->voorvoegsel,true);
		$criteria->compare('emailAdres',$this->emailAdres,true);
		$criteria->compare('straat',$this->straat,true);
		$criteria->compare('huisNummer',$this->huisNummer,true);
		$criteria->compare('toevoeging',$this->toevoeging,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('plaats',$this->plaats,true);
		$criteria->compare('geboorteDatum',$this->geboorteDatum,true);
		$criteria->compare('telefoonNummer',$this->telefoonNummer);
		$criteria->compare('leden_personeelsnummer',$this->leden_personeelsnummer,true);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}