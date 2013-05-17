<?php

/**
 * This is the model class for table "secties_has_navigation".
 *
 * The followings are the available columns in table 'secties_has_navigation':
 * @property integer $id
 * @property integer $secties_id
 * @property string $route
 * @property string $naam
 * @property integer $prio
 * @property string $datumAangemaakt
 * @property string $datumAangepast
 * @property string $userAangemaakt
 * @property string $userAangepast
 *
 * The followings are the available model relations:
 * @property Admin $userAangepast0
 * @property Secties $secties
 * @property Admin $userAangemaakt0
 */
class SectiesHasNavigation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SectiesHasNavigation the static model class
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
		return 'secties_has_navigation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('secties_id, route, naam, prio, datumAangemaakt, userAangemaakt', 'required'),
			array('secties_id, prio', 'numerical', 'integerOnly'=>true),
			array('route, naam', 'length', 'max'=>45),
			array('userAangemaakt, userAangepast', 'length', 'max'=>15),
			array('datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, secties_id, route, naam, prio, datumAangemaakt, datumAangepast, userAangemaakt, userAangepast', 'safe', 'on'=>'search'),
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
			'userAangepast0' => array(self::BELONGS_TO, 'Admin', 'userAangepast'),
			'secties' => array(self::BELONGS_TO, 'Secties', 'secties_id'),
			'userAangemaakt0' => array(self::BELONGS_TO, 'Admin', 'userAangemaakt'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'secties_id' => 'Secties',
			'route' => 'Route',
			'naam' => 'Naam',
			'prio' => 'Prio',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('secties_id',$this->secties_id);
		$criteria->compare('route',$this->route,true);
		$criteria->compare('naam',$this->naam,true);
		$criteria->compare('prio',$this->prio);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * @return array the ordered on prio subnavigation for sectie
	 */
	public function findSubnavSecties($sectieid)
	{
		$criteria = new CDbCriteria;
		$criteria->condition='secties_id = :sectie';
		$criteria->params= array(':sectie' => $sectieid);
		return $this->findAll($criteria);
	}
}