<?php

/**
 * This is the model class for table "secties".
 *
 * The followings are the available columns in table 'secties':
 * @property integer $id
 * @property string $naam
 * @property string $email
 * @property string $info
 * @property integer $competitieModule
 * @property string $datumAangemaakt
 * @property string $datumAangepast
 * @property string $userAangemaakt
 * @property string $userAangepast
 *
 * The followings are the available model relations:
 * @property Activiteit[] $activiteits
 * @property Agenda[] $agendas
 * @property Functies[] $functies
 * @property Leden $userAangemaakt0
 * @property Leden $userAangepast0
 * @property Content[] $contents
 * @property Leden[] $ledens
 */
class Secties extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Secties the static model class
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
		return 'secties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('datumAangemaakt, userAangemaakt', 'required'),
			array('competitieModule', 'numerical', 'integerOnly'=>true),
			array('naam, email', 'length', 'max'=>45),
			array('userAangemaakt, userAangepast', 'length', 'max'=>15),
			array('info, datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naam, email, info, competitieModule, datumAangemaakt, datumAangepast, userAangemaakt, userAangepast', 'safe', 'on'=>'search'),
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
			'activiteits' => array(self::HAS_MANY, 'Activiteit', 'secties_id'),
			'agendas' => array(self::HAS_MANY, 'Agenda', 'secties_id'),
			'functies' => array(self::HAS_MANY, 'Functies', 'secties_id'),
			'userAangemaakt0' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'userAangepast0' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'contents' => array(self::MANY_MANY, 'Content', 'secties_has_content(secties_id, content_id)'),
			'ledens' => array(self::MANY_MANY, 'Leden', 'secties_has_leden(secties_id, leden_personeelsnummer)'),
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
			'email' => 'Email',
			'info' => 'Info',
			'competitieModule' => 'Competitie Module',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('competitieModule',$this->competitieModule);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}