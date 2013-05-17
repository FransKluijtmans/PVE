<?php

/**
 * This is the model class for table "leden_cspa".
 *
 * The followings are the available columns in table 'leden_cspa':
 * @property string $personeelsnummer
 * @property string $aanhef
 * @property string $voorletters
 * @property string $achternaam
 * @property string $voorvoegsel
 * @property string $tweede_achternaam
 * @property string $tweede_voorvoegsel
 * @property string $adres
 * @property string $postcode
 * @property string $plaats
 * @property string $geboortedatum
 * @property string $bijdrage
 * @property integer $pv
 *
 * The followings are the available model relations:
 * @property Leden $personeelsnummer0
 */
class LedenCspa extends CActiveRecord
{
	public $files;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedenCspa the static model class
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
		return 'leden_cspa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('files', 'file', 'allowEmpty' => false, 'types'=>'xls,xlsx', 'on'=>'upload'),
			array('personeelsnummer, aanhef, voorletters, achternaam, adres, postcode, plaats, geboortedatum', 'required', 'on'=>'save'),
			array('pv, personeelsnummer', 'numerical', 'integerOnly'=>true),
			array('personeelsnummer', 'length', 'max'=>15),
			array('aanhef, bijdrage', 'length', 'max'=>6),
			array('voorletters, voorvoegsel, tweede_voorvoegsel', 'length', 'max'=>10),
			array('achternaam, tweede_achternaam', 'length', 'max'=>30),
			array('adres, plaats', 'length', 'max'=>50),
			array('postcode', 'length', 'max'=>7),
			array('adres, plaats', 'match', 'pattern'=>'/^[ÀÈÌÒÙàèìòùÁÉÍÓÚÝáéíóúýÂÊÎÔÛâêîôûÃÑÕãñõÄËÏÖÜŸäëïöüŸçÇŒœßØøÅåÆæÞþÐð""\w\d\s-\'.,&]+$/', 'message' => 'Het veld {attribute} is niet correct gevuld.'),
			array('achternaam, voorletters', 'match', 'not' => false, 'pattern'=>'/^[ÀÈÌÒÙàèìòùÁÉÍÓÚÝáéíóúýÂÊÎÔÛâêîôûÃÑÕãñõÄËÏÖÜŸäëïöüŸçÇŒœßØøÅåÆæÞþÐð""\w\s-\']+$/', 'message' => 'Het veld {attribute} is niet correct gevuld.'),
			array('postcode', 'match', 'pattern'=>'/^([0-9]{4}[a-zA-Z]{2})$/', 'message' => 'Dit is geen correcte {attribute}.'),
			array('geboortedatum', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd', 'message' => 'Dit is geen goede {attribute}.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('personeelsnummer, aanhef, voorletters, achternaam, voorvoegsel, tweede_achternaam, tweede_voorvoegsel, adres, postcode, plaats, geboortedatum, bijdrage, pv', 'safe', 'on'=>'search'),
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
			'personeelsnummer0' => array(self::BELONGS_TO, 'Leden', 'personeelsnummer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'personeelsnummer' => 'Personeelsnummer',
			'aanhef' => 'Aanhef',
			'voorletters' => 'Voorletters',
			'achternaam' => 'Achternaam',
			'voorvoegsel' => 'Voorvoegsel',
			'tweede_achternaam' => 'Tweede Achternaam',
			'tweede_voorvoegsel' => 'Tweede Voorvoegsel',
			'adres' => 'Adres',
			'postcode' => 'Postcode',
			'plaats' => 'Plaats',
			'geboortedatum' => 'Geboortedatum',
			'bijdrage' => 'Bijdrage',
			'pv' => 'Pv',
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

		$criteria->compare('personeelsnummer',$this->personeelsnummer,true);
		$criteria->compare('aanhef',$this->aanhef,true);
		$criteria->compare('voorletters',$this->voorletters,true);
		$criteria->compare('achternaam',$this->achternaam,true);
		$criteria->compare('voorvoegsel',$this->voorvoegsel,true);
		$criteria->compare('tweede_achternaam',$this->tweede_achternaam,true);
		$criteria->compare('tweede_voorvoegsel',$this->tweede_voorvoegsel,true);
		$criteria->compare('adres',$this->adres,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('plaats',$this->plaats,true);
		$criteria->compare('geboortedatum',$this->geboortedatum,true);
		$criteria->compare('bijdrage',$this->bijdrage,true);
		$criteria->compare('pv',$this->pv);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}