<?php

/**
 * This is the model class for table "activiteit_opties".
 *
 * The followings are the available columns in table 'activiteit_opties':
 * @property integer $activiteit_id
 * @property integer $id
 * @property integer $maxInschrijvingLid
 * @property string $omschrijving
 * @property string $kosten
 * @property integer $media_id
 *
 * The followings are the available model relations:
 * @property AanmeldingActiviteitHasActiviteitOpties[] $aanmeldingActiviteitHasActiviteitOpties
 * @property Activiteit $activiteit
 * @property Media $media
 */
class ActiviteitOpties extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ActiviteitOpties the static model class
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
		return 'activiteit_opties';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('activiteit_id, maxInschrijvingLid, omschrijving, kosten', 'required'),
			array('activiteit_id, maxInschrijvingLid, media_id', 'numerical', 'integerOnly'=>true),
			array('omschrijving', 'length', 'max'=>45),
			array('kosten', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('activiteit_id, id, maxInschrijvingLid, omschrijving, kosten, media_id', 'safe', 'on'=>'search'),
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
			'aanmeldingActiviteitHasActiviteitOpties' => array(self::HAS_MANY, 'AanmeldingActiviteitHasActiviteitOpties', 'activiteit_opties_id'),
			'activiteit' => array(self::BELONGS_TO, 'Activiteit', 'activiteit_id'),
			'media' => array(self::BELONGS_TO, 'Media', 'media_id'),
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
			'maxInschrijvingLid' => 'Max Inschrijving Lid',
			'omschrijving' => 'Omschrijving',
			'kosten' => 'Kosten',
			'media_id' => 'Media',
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
		$criteria->compare('maxInschrijvingLid',$this->maxInschrijvingLid);
		$criteria->compare('omschrijving',$this->omschrijving,true);
		$criteria->compare('kosten',$this->kosten,true);
		$criteria->compare('media_id',$this->media_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}