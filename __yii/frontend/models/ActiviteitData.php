<?php

/**
 * This is the model class for table "activiteit_data".
 *
 * The followings are the available columns in table 'activiteit_data':
 * @property integer $activiteit_id
 * @property integer $id
 * @property integer $maxInschrijving
 * @property string $datum
 * @property string $tijdstip
 *
 * The followings are the available model relations:
 * @property AanmeldingActiviteitHasActiviteitOpties[] $aanmeldingActiviteitHasActiviteitOpties
 * @property Activiteit $activiteit
 */
class ActiviteitData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ActiviteitData the static model class
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
		return 'activiteit_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activiteit_id, maxInschrijving, datum, tijdstip', 'required'),
			array('activiteit_id, maxInschrijving', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activiteit_id, id, maxInschrijving, datum, tijdstip', 'safe', 'on'=>'search'),
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
			'aanmeldingActiviteitHasActiviteitOpties' => array(self::HAS_MANY, 'AanmeldingActiviteitHasActiviteitOpties', 'activiteit_data_id'),
			'activiteit' => array(self::BELONGS_TO, 'Activiteit', 'activiteit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'activiteit_id' => 'Activiteit',
			'id' => 'ID',
			'maxInschrijving' => 'Max Inschrijving',
			'datum' => 'Datum',
			'tijdstip' => 'Tijdstip',
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

		$criteria->compare('activiteit_id',$this->activiteit_id);
		$criteria->compare('id',$this->id);
		$criteria->compare('maxInschrijving',$this->maxInschrijving);
		$criteria->compare('datum',$this->datum,true);
		$criteria->compare('tijdstip',$this->tijdstip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}