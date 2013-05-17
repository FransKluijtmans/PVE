<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $id
 * @property string $titel
 * @property string $content
 * @property string $datumAangemaakt
 * @property string $datumAangepast
 * @property string $userAangepast
 * @property integer $icoonId
 * @property string $userAangemaakt
 *
 * The followings are the available model relations:
 * @property Activiteit[] $activiteits
 * @property Agenda[] $agendas
 * @property Leden $userAangemaakt0
 * @property Leden $userAangepast0
 * @property ContentCategory[] $contentCategories
 * @property Media[] $medias
 * @property Secties[] $secties
 */
class Content extends CActiveRecord
{
	public $content_category_id;
	public $content_id;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
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
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titel, datumAangemaakt, icoonId, userAangemaakt', 'required'),
			array('icoonId', 'numerical', 'integerOnly'=>true),
			array('titel', 'length', 'max'=>80),
			array('userAangepast, userAangemaakt', 'length', 'max'=>15),
			array('content, datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, titel, content, datumAangemaakt, datumAangepast, userAangepast, icoonId, userAangemaakt, content_category_id, content_id', 'safe', 'on'=>'search'),
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
			'activiteits' => array(self::HAS_MANY, 'Activiteit', 'content_id'),
			'agendas' => array(self::MANY_MANY, 'Agenda', 'agenda_has_content(content_id, agenda_id)'),
			'userAangemaakt0' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'userAangepast0' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'contentCategories' => array(self::MANY_MANY, 'ContentCategory', 'content_has_content_category(content_id, content_category_id)'),
			'medias' => array(self::MANY_MANY, 'Media', 'media_has_content(nieuws_id, media_id)'),
			'secties' => array(self::MANY_MANY, 'Secties', 'secties_has_content(content_id, secties_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'titel' => 'Titel',
			'content' => 'Content',
			'datumAangemaakt' => 'Datum Aangemaakt',
			'datumAangepast' => 'Datum Aangepast',
			'userAangepast' => 'User Aangepast',
			'icoonId' => 'Icoon',
			'userAangemaakt' => 'User Aangemaakt',
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
		$criteria->compare('titel',$this->titel,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);
		$criteria->compare('icoonId',$this->icoonId);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		$criteria->compare('content_id',$this->content_id,true);
		$criteria->compare('content_category_id',$this->content_category_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * @param integer the maximum number of articles that should be returned
	 * @return array the most recently added articles
	 */
	public function findRecentArticles($limit=10)
	{
		$criteria = new CDbCriteria;
		$criteria->with = array(
   			"contentCategories"=>array('condition'=>'content_category_id = 2'),
   			//"userCalendar"=>array('condition'=> 'user_id =' . $user->id),
		);
		return $this->findAll($criteria);
	}
}