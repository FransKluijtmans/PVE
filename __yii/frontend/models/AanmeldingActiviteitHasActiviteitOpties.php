<?php

/**
 * This is the model class for table "aanmelding_activiteit_has_activiteit_opties".
 *
 * The followings are the available columns in table 'aanmelding_activiteit_has_activiteit_opties':
 * @property integer $aanmelding_activiteit_tbl_activiteit_id
 * @property integer $activiteit_opties_id
 * @property string $aantalAanmeldingen
 * @property integer $activiteit_data_id
 * @property string $deelnemer
 *
 * The followings are the available model relations:
 * @property AanmeldingActiviteit $aanmeldingActiviteitTblActiviteit
 * @property ActiviteitOpties $activiteitOpties
 * @property ActiviteitData $activiteitData
 * @property Introducee $deelnemer0
 */
class AanmeldingActiviteitHasActiviteitOpties extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AanmeldingActiviteitHasActiviteitOpties the static model class
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
		return 'aanmelding_activiteit_has_activiteit_opties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('aanmelding_activiteit_tbl_activiteit_id, activiteit_opties_id, activiteit_data_id, deelnemer', 'required'),
			array('aanmelding_activiteit_tbl_activiteit_id, activiteit_opties_id, activiteit_data_id', 'numerical', 'integerOnly'=>true),
			array('aantalAanmeldingen', 'length', 'max'=>45),
			array('deelnemer', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('aanmelding_activiteit_tbl_activiteit_id, activiteit_opties_id, aantalAanmeldingen, activiteit_data_id, deelnemer', 'safe', 'on'=>'search'),
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
			'aanmeldingActiviteitTblActiviteit' => array(self::BELONGS_TO, 'AanmeldingActiviteit', 'aanmelding_activiteit_tbl_activiteit_id'),
			'activiteitOpties' => array(self::BELONGS_TO, 'ActiviteitOpties', 'activiteit_opties_id'),
			'activiteitData' => array(self::BELONGS_TO, 'ActiviteitData', 'activiteit_data_id'),
			'deelnemer0' => array(self::BELONGS_TO, 'Introducee', 'deelnemer'),
			//relation with base table exsists through activiteit_opties  
			'activiteit'=>array(
                self::HAS_MANY,'Activiteit',array('activiteit_id'=>'id'),'through'=>'activiteitOpties'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'aanmelding_activiteit_tbl_activiteit_id' => 'Aanmelding Activiteit Tbl Activiteit',
			'activiteit_opties_id' => 'Activiteit Opties',
			'aantalAanmeldingen' => 'Aantal Aanmeldingen',
			'activiteit_data_id' => 'Activiteit Data',
			'deelnemer' => 'Deelnemer',
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

		$criteria->compare('aanmelding_activiteit_tbl_activiteit_id',$this->aanmelding_activiteit_tbl_activiteit_id);
		$criteria->compare('activiteit_opties_id',$this->activiteit_opties_id);
		$criteria->compare('aantalAanmeldingen',$this->aantalAanmeldingen,true);
		$criteria->compare('activiteit_data_id',$this->activiteit_data_id);
		$criteria->compare('deelnemer',$this->deelnemer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}