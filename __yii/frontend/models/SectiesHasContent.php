<?php

/**
 * This is the model class for table "secties_has_content".
 *
 * The followings are the available columns in table 'secties_has_content':
 * @property integer $content_id
 * @property integer $secties_id
 * @property integer $alleenSecties
 */
class SectiesHasContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SectiesHasContent the static model class
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
		return 'secties_has_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content_id, secties_id', 'required'),
			array('content_id, secties_id, alleenSecties', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('content_id, secties_id, alleenSecties', 'safe', 'on'=>'search'),
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
			'content_id' => 'Content',
			'secties_id' => 'Secties',
			'alleenSecties' => 'Alleen Secties',
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

		$criteria->compare('content_id',$this->content_id);
		$criteria->compare('secties_id',$this->secties_id);
		$criteria->compare('alleenSecties',$this->alleenSecties);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}