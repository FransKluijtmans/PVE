<?php

/**
 * This is the model class for table "admin".
 *
 * The followings are the available columns in table 'admin':
 * @property integer $id
 * @property string $wachtwoord
 * @property string $datumGewijzigd
 * @property integer $initieelGewijzigd
 * @property string $leden_personeelsnummer
 * @property integer $functies_id
 *
 * The followings are the available model relations:
 * @property Functies $functies
 * @property Leden $ledenPersoneelsnummer
 */
class Admin extends CActiveRecord
{
	public $functiesOmschrijving;
	public $achternaam;
	
	// holds the password confirmation word
    public $repeat_wachtwoord;
 
    //will hold the encrypted password for update actions.
    public $huidige_wachtwoord;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin the static model class
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
		return 'admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('huidige_wachtwoord', 'authenticateWachtwoord', 'on'=>'update'),
			array('repeat_wachtwoord, huidige_wachtwoord', 'required', 'on'=>'update'),
			array('wachtwoord, repeat_wachtwoord, huidige_wachtwoord', 'length', 'min'=>5, 'max'=>40),
			array('wachtwoord', 'VPasswordStrength', 'strength' => VPasswordStrength::STRONG, 'on'=>'update'),
			array('wachtwoord', 'compare', 'compareAttribute'=>'repeat_wachtwoord', 'on'=>'update'),
			array('wachtwoord', 'compare', 'compareAttribute'=>'huidige_wachtwoord', 'operator'=>'!=', 'on'=>'update', 'message'=>'Het nieuwe wachtwoord mag niet hetzelfde zijn als het oude.'),
			array('wachtwoord, leden_personeelsnummer, functies_id', 'required'),
			array('initieelGewijzigd, functies_id', 'numerical', 'integerOnly'=>true),
			array('leden_personeelsnummer', 'length', 'min'=>1, 'max'=>15),
			array('datumGewijzigd', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('datumGewijzigd, initieelGewijzigd, leden_personeelsnummer, functies_id, functiesOmschrijving, achternaam', 'safe', 'on'=>'search'),
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
			'functies' => array(self::BELONGS_TO, 'Functies', 'functies_id'),
			'ledenPersoneelsnummer' => array(self::BELONGS_TO, 'Leden', 'leden_personeelsnummer', 'order'=>'achternaam ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'wachtwoord' => 'Wachtwoord',
			'huidige_wachtwoord' => 'Huidige wachtwoord',
			'repeat_wachtwoord' => 'Herhaal wachtwoord',
			'datumGewijzigd' => 'Datum gewijzigd',
			'initieelGewijzigd' => 'Initieel gewijzigd',
			'leden_personeelsnummer' => 'Personeelsnummer',
			'functies_id' => 'Functie',
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
		//$criteria->compare('wachtwoord',$this->wachtwoord,true);
		//$criteria->compare('datumGewijzigd',$this->datumGewijzigd,true);
		//$criteria->compare('initieelGewijzigd',$this->initieelGewijzigd);
		$criteria->compare('leden_personeelsnummer',$this->leden_personeelsnummer,true);
		$criteria->compare('functies_id',$this->functies_id);
		//extra kolom uit de functies tabel toevoegen
		$criteria->with = array( 'functies' );
		$criteria->compare( 'functies.omschrijving', $this->functiesOmschrijving,true );
		//extra kolom uit de leden tabel toevoegen
		$criteria->with = array( 'ledenPersoneelsnummer' );
		$criteria->compare( 'ledenPersoneelsnummer.achternaam', $this->achternaam,true );
		
		$sort = new CSort();
		$sort->attributes = array(
			'defaultOrder'=>'t.create_time DESC',
			'leden_personeelsnummer'=>array(
				'asc'=>'t.leden_personeelsnummer',
				'desc'=>'t.leden_personeelsnummer desc',
			),
			'functiesOmschrijving'=>array(
				'asc'=>'functies.omschrijving',
				'desc'=>'functies.omschrijving desc',
			),
			'achternaam'=>array(
				'asc'=>'ledenPersoneelsnummer.achternaam',
				'desc'=>'ledenPersoneelsnummer.achternaam desc',
			),
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
    		'sort'=>$sort,
		));
	}
	public function beforeSave()
	{
		$ph=new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'], Yii::app()->params['phpass']['portable_hashes']);
		$this->wachtwoord=$ph->HashPassword($this->wachtwoord);
		
		return parent::beforeSave();
	}
	
	public function authenticateWachtwoord($attribute,$params)
	{
		$record=Admin::model()->findByAttributes(array('id'=>$this->id));
		$ph=new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'], Yii::app()->params['phpass']['portable_hashes']);

		if(!$ph->CheckPassword($this->huidige_wachtwoord, $record->wachtwoord)){
			$this->addError($attribute, 'Dit is niet je huidige wachtwoord');
		}
	}
}