<?php

/**
 * This is the model class for table "secties_has_leden".
 *
 * The followings are the available columns in table 'secties_has_leden':
 * @property integer $secties_id
 * @property string $leden_personeelsnummer
 */
class SectiesHasLeden extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SectiesHasLeden the static model class
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
		return 'secties_has_leden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('secties_id, leden_personeelsnummer', 'required'),
			array('secties_id', 'numerical', 'integerOnly'=>true),
			array('leden_personeelsnummer', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('secties_id, leden_personeelsnummer', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'secties_id' => 'Secties',
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

		$criteria->compare('secties_id',$this->secties_id);
		$criteria->compare('leden_personeelsnummer',$this->leden_personeelsnummer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}