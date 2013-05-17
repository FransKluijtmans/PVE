<?php

/**
 * This is the model class for table "leden_login".
 *
 * The followings are the available columns in table 'leden_login':
 * @property integer $id
 * @property string $datumGewijzigd
 * @property string $wachtwoord
 * @property string $datumAangemaakt
 * @property integer $initieelGewijzigd
 * @property string $leden_personeelsnummer
 *
 * The followings are the available model relations:
 * @property Leden $ledenPersoneelsnummer
 */
class LedenLogin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedenLogin the static model class
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
		return 'leden_login';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('wachtwoord, datumAangemaakt, leden_personeelsnummer', 'required'),
			array('initieelGewijzigd', 'numerical', 'integerOnly'=>true),
			array('wachtwoord', 'length', 'max'=>200),
			array('leden_personeelsnummer', 'length', 'max'=>15),
			array('datumGewijzigd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, datumGewijzigd, wachtwoord, datumAangemaakt, initieelGewijzigd, leden_personeelsnummer', 'safe', 'on'=>'search'),
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
			'datumGewijzigd' => 'Datum Gewijzigd',
			'wachtwoord' => 'Wachtwoord',
			'datumAangemaakt' => 'Datum Aangemaakt',
			'initieelGewijzigd' => 'Initieel Gewijzigd',
			'leden_personeelsnummer' => 'Leden Personeelsnummer',
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
		$criteria->compare('datumGewijzigd',$this->datumGewijzigd,true);
		$criteria->compare('wachtwoord',$this->wachtwoord,true);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('initieelGewijzigd',$this->initieelGewijzigd);
		$criteria->compare('leden_personeelsnummer',$this->leden_personeelsnummer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}