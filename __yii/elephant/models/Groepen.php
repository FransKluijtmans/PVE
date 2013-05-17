<?php

/**
 * This is the model class for table "groepen".
 *
 * The followings are the available columns in table 'groepen':
 * @property integer $id
 * @property string $naam
 * @property string $datumAangemaakt
 * @property string $datumAangepast
 * @property string $userAangemaakt
 * @property string $userAangepast
 *
 * The followings are the available model relations:
 * @property Activiteit[] $activiteits
 * @property Leden $userAangemaakt0
 * @property Leden $userAangepast0
 * @property Leden[] $ledens
 */
class Groepen extends CActiveRecord
{
	public $aantalLeden;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Groepen the static model class
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
		return 'groepen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naam, datumAangemaakt, userAangemaakt', 'required'),
			array('naam', 'length', 'max'=>45),
			array('userAangemaakt, userAangepast', 'length', 'max'=>15),
			array('userAangepast, userAangepast', 'required', 'on'=>'update'),
			// array('datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naam, datumAangemaakt, datumAangepast, userAangemaakt, userAangepast', 'safe', 'on'=>'search'),
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
			'activiteits' => array(self::MANY_MANY, 'Activiteit', 'activiteit_has_groepen(groepen_id, activiteit_id)'),
			'usersAangemaakt' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'usersAangepast' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'ledens' => array(self::MANY_MANY, 'Leden', 'leden_has_groepen(groepen_id, leden_personeelsnummer)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'naam' => 'Naam',
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
		$criteria->compare('naam',$this->naam,true);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}