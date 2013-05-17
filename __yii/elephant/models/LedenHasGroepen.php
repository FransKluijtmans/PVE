<?php

/**
 * This is the model class for table "leden_has_groepen".
 *
 * The followings are the available columns in table 'leden_has_groepen':
 * @property string $leden_personeelsnummer
 * @property integer $groepen_id
 */
class LedenHasGroepen extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LedenHasGroepen the static model class
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
		return 'leden_has_groepen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('leden_personeelsnummer, groepen_id', 'required'),
			array('groepen_id', 'numerical', 'integerOnly'=>true),
			array('leden_personeelsnummer', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('leden_personeelsnummer, groepen_id', 'safe', 'on'=>'search'),
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
			'leden_personeelsnummer' => 'Leden Personeelsnummer',
			'groepen_id' => 'Groepen',
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

		$criteria->compare('leden_personeelsnummer',$this->leden_personeelsnummer,true);
		$criteria->compare('groepen_id',$this->groepen_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}