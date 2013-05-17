<?php

/**
 * This is the model class for table "agenda".
 *
 * The followings are the available columns in table 'agenda':
 * @property integer $id
 * @property string $omschrijving
 * @property string $datum
 * @property string $datumAangemaakt
 * @property string $datumAangepast
 * @property integer $secties_id
 * @property string $userAangemaakt
 * @property string $userAangepast
 *
 * The followings are the available model relations:
 * @property Leden $userAangemaakt0
 * @property Leden $userAangepast0
 * @property Secties $secties
 * @property Content[] $contents
 */
class Agenda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Agenda the static model class
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
		return 'agenda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('omschrijving, datum, datumAangemaakt, secties_id, userAangemaakt', 'required'),
			array('secties_id', 'numerical', 'integerOnly'=>true),
			array('omschrijving', 'length', 'max'=>45),
			array('userAangemaakt, userAangepast', 'length', 'max'=>15),
			array('datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, omschrijving, datum, datumAangemaakt, datumAangepast, secties_id, userAangemaakt, userAangepast', 'safe', 'on'=>'search'),
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
			'userAangemaakt0' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'userAangepast0' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'secties' => array(self::BELONGS_TO, 'Secties', 'secties_id'),
			'contents' => array(self::MANY_MANY, 'Content', 'agenda_has_content(agenda_id, content_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'omschrijving' => 'Omschrijving',
			'datum' => 'Datum',
			'datumAangemaakt' => 'Datum Aangemaakt',
			'datumAangepast' => 'Datum Aangepast',
			'secties_id' => 'Secties',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('omschrijving',$this->omschrijving,true);
		$criteria->compare('datum',$this->datum,true);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('secties_id',$this->secties_id);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}