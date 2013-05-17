<?php

/**
 * This is the model class for table "aanmelding_activiteit".
 *
 * The followings are the available columns in table 'aanmelding_activiteit':
 * @property integer $id
 * @property string $leden_personeelsnummer
 * @property integer $eigenVervoer
 * @property string $extraInfo
 * @property string $datumAanmelding
 *
 * The followings are the available model relations:
 * @property AanmeldingActiviteitHasActiviteitOpties[] $aanmeldingActiviteitHasActiviteitOpties
 */
class AanmeldingActiviteit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AanmeldingActiviteit the static model class
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
		return 'aanmelding_activiteit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, leden_personeelsnummer, datumAanmelding', 'required'),
			array('id, eigenVervoer', 'numerical', 'integerOnly'=>true),
			array('leden_personeelsnummer', 'length', 'max'=>15),
			array('extraInfo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, leden_personeelsnummer, eigenVervoer, extraInfo, datumAanmelding', 'safe', 'on'=>'search'),
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
			'aanmeldingActiviteitHasActiviteitOpties' => array(self::HAS_MANY, 'AanmeldingActiviteitHasActiviteitOpties', 'aanmelding_activiteit_tbl_activiteit_id'),
			//relation with base table exsists through activiteit_opties  
			'activiteit' => array(self::HAS_MANY, 'Activiteit', 'activiteit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'leden_personeelsnummer' => 'Leden Personeelsnummer',
			'eigenVervoer' => 'Eigen Vervoer',
			'extraInfo' => 'Extra Info',
			'datumAanmelding' => 'Datum Aanmelding',
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
		$criteria->compare('leden_personeelsnummer',$this->leden_personeelsnummer,true);
		$criteria->compare('eigenVervoer',$this->eigenVervoer);
		$criteria->compare('extraInfo',$this->extraInfo,true);
		$criteria->compare('datumAanmelding',$this->datumAanmelding,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}