<?php

/**
 * This is the model class for table "leden".
 *
 * The followings are the available columns in table 'leden':
 * @property string $personeelsnummer
 * @property string $aanhef
 * @property string $voorletters
 * @property string $achternaam
 * @property string $voorvoegsel
 * @property string $emailAdres
 * @property string $rekeningNummer
 * @property string $straat
 * @property string $huisNummer
 * @property string $toevoeging
 * @property string $postcode
 * @property string $plaats
 * @property string $geboorteDatum
 * @property integer $telefoonNummer
 * @property string $datumGewijzigd
 * @property integer $statusAanmelding
 * @property string $afdeling
 * @property string $redenLid
 * @property integer $werkendLid
 * @property string $ledenFunctie
 * @property string $datumAangemaakt
 * @property string $datumAangepast
 * @property string $userAangemaakt
 * @property string $userAangepast
 *
 * The followings are the available model relations:
 * @property Activiteit[] $activiteits
 * @property Activiteit[] $activiteits1
 * @property Activiteit[] $activiteits2
 * @property Admin[] $admins
 * @property Agenda[] $agendas
 * @property Agenda[] $agendas1
 * @property Bestuurfunctie[] $bestuurfuncties
 * @property Bestuurfunctie[] $bestuurfuncties1
 * @property Content[] $contents
 * @property Content[] $contents1
 * @property Functies[] $functies
 * @property Functies[] $functies1
 * @property Groepen[] $groepens
 * @property Groepen[] $groepens1
 * @property Leden $userAangemaakt0
 * @property Leden[] $ledens
 * @property Media[] $medias
 * @property Media[] $medias1
 * @property Secties[] $secties
 * @property Secties[] $secties1
 * @property Tags[] $tags
 * @property Tags[] $tags1
 */
class Leden extends CActiveRecord
{
	
	//geboortedatum
	public $geboorteDag;
	public $geboorteMaand;
	public $geboorteJaar;
	public $groepens;
	public $aantalLeden;
	public $yearmonth;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Leden the static model class
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
		return 'leden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('personeelsnummer, voorletters, achternaam, straat, huisNummer, plaats, datumAangemaakt, userAangemaakt, geboorteDatum', 'required'),
			array('telefoonNummer, statusAanmelding, werkendLid, rekeningNummer', 'numerical', 'integerOnly'=>true),
			array('personeelsnummer, userAangemaakt, userAangepast', 'length', 'max'=>15),
			array('voorletters, aanhef', 'length', 'max'=>5),
			array('plaats, straat, achternaam, emailAdres, afdeling', 'length', 'max'=>45),
			array('afdeling', 'match', 'pattern'=>'/^[a-zA-Z\s\'-]+$/'),
			array('straat, plaats', 'match', 'pattern'=>'/^[ÀÈÌÒÙàèìòùÁÉÍÓÚÝáéíóúýÂÊÎÔÛâêîôûÃÑÕãñõÄËÏÖÜŸäëïöüŸçÇŒœßØøÅåÆæÞþÐð""\w\s-\'.,&]+$/', 'message' => 'Het veld {attribute} is niet correct gevuld.'),
			array('achternaam, voorletters', 'match', 'not' => false, 'pattern'=>'/^[ÀÈÌÒÙàèìòùÁÉÍÓÚÝáéíóúýÂÊÎÔÛâêîôûÃÑÕãñõÄËÏÖÜŸäëïöüŸçÇŒœßØøÅåÆæÞþÐð""\w\s-\']+$/', 'message' => 'Het veld {attribute} is niet correct gevuld.'),
			array('voorvoegsel, rekeningNummer', 'length', 'max'=>10),
			array('huisNummer', 'length', 'max'=>4),
			array('toevoeging', 'length', 'max'=>2),
			array('postcode', 'length', 'max'=>6),
			array('postcode', 'match', 'pattern'=>'/^([0-9]{4}[a-zA-Z]{2})$/'),
			array('redenLid', 'length', 'max'=>255),
			array('ledenFunctie', 'length', 'max'=>11),
			array('geboorteDatum, datumGewijzigd, datumAangepast', 'safe'),
			array('emailAdres', 'email'),
			array('geboorteDatum', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-m-d', 'message' => 'Dit is geen goede {attribute}.', 'allowEmpty'=>false),
			array('geboorteDatum', 'compareDateRange', 'type' => 'date'),
            array('geboorteDatum', 'validateDate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('personeelsnummer, aanhef, voorletters, achternaam, voorvoegsel, emailAdres, rekeningNummer, straat, huisNummer, toevoeging, postcode, plaats, geboorteDatum, telefoonNummer, datumGewijzigd, statusAanmelding, afdeling, redenLid, werkendLid, ledenFunctie, datumAangemaakt, datumAangepast, userAangemaakt, userAangepast', 'safe', 'on'=>'search'),
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
			'activiteits' => array(self::MANY_MANY, 'Activiteit', 'aanmelding_activiteit(leden_personeelsnummer, id)'),
			'activiteits1' => array(self::HAS_MANY, 'Activiteit', 'userAangepast'),
			'activiteits2' => array(self::HAS_MANY, 'Activiteit', 'userAangemaakt'),
			'admins' => array(self::HAS_MANY, 'Admin', 'personeelsnummer'),
			'adminPersoneelsnummer' => array(self::BELONGS_TO, 'Admin', 'personeelsnummer'),
			'agendas' => array(self::HAS_MANY, 'Agenda', 'userAangemaakt'),
			'agendas1' => array(self::HAS_MANY, 'Agenda', 'userAangepast'),
			'bestuurfuncties' => array(self::MANY_MANY, 'Bestuurfunctie', 'bestuurfunctie_has_leden(leden_personeelsnummer, bestuurfunctie_id)'),
			'bestuurfuncties1' => array(self::HAS_MANY, 'Bestuurfunctie', 'userAangepast'),
			'contents' => array(self::HAS_MANY, 'Content', 'userAangemaakt'),
			'contents1' => array(self::HAS_MANY, 'Content', 'userAangepast'),
			'functies' => array(self::HAS_MANY, 'Functies', 'userAangemaakt'),
			'functies1' => array(self::HAS_MANY, 'Functies', 'userAangepast'),
			'groepens' => array(self::MANY_MANY, 'Groepen', 'leden_has_groepen(leden_personeelsnummer, groepen_id)'),
			'groepens1' => array(self::HAS_MANY, 'Groepen', 'userAangepast'),
			'usersAangemaakt' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'usersAangepast' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'ledens' => array(self::HAS_MANY, 'Leden', 'userAangemaakt'),
			'medias' => array(self::HAS_MANY, 'Media', 'userAangepast'),
			'medias1' => array(self::HAS_MANY, 'Media', 'userAangemaakt'),
			'secties' => array(self::MANY_MANY, 'Secties', 'secties_has_leden(leden_personeelsnummer, secties_id)'),
			'secties1' => array(self::HAS_MANY, 'Secties', 'userAangepast'),
			'tags' => array(self::HAS_MANY, 'Tags', 'UserAangemaakt'),
			'tags1' => array(self::HAS_MANY, 'Tags', 'UserAangepast'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'personeelsnummer' => 'Personeelsnummer',
			'aanhef' => 'Aanhef',
			'voorletters' => 'Voorletters',
			'achternaam' => 'Achternaam',
			'voorvoegsel' => 'Voorvoegsel',
			'emailAdres' => 'Emailadres',
			'rekeningNummer' => 'Rekeningnummer',
			'straat' => 'Straat',
			'huisNummer' => 'Huisnummer',
			'toevoeging' => 'Toevoeging',
			'postcode' => 'Postcode',
			'plaats' => 'Plaats',
			'geboorteDatum' => 'Geboortedatum',
			'telefoonNummer' => 'Telefoonnummer',
			'datumGewijzigd' => 'Datum Gewijzigd',
			'statusAanmelding' => 'Status Aanmelding',
			'afdeling' => 'Afdeling',
			'redenLid' => 'Reden Lid',
			'werkendLid' => 'Werkend Lid',
			'ledenFunctie' => 'Leden Functie',
			'datumAangemaakt' => 'Datum Aangemaakt',
			'datumAangepast' => 'Datum Aangepast',
			'userAangemaakt' => 'User Aangemaakt',
			'userAangepast' => 'User Aangepast',
			'groepens' => 'Groepen',
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

		$criteria->compare('personeelsnummer',$this->personeelsnummer,true);
		$criteria->compare('aanhef',$this->aanhef,true);
		$criteria->compare('voorletters',$this->voorletters,true);
		$criteria->compare('achternaam',$this->achternaam,true);
		$criteria->compare('voorvoegsel',$this->voorvoegsel,true);
		$criteria->compare('emailAdres',$this->emailAdres,true);
		$criteria->compare('rekeningNummer',$this->rekeningNummer,true);
		$criteria->compare('straat',$this->straat,true);
		$criteria->compare('huisNummer',$this->huisNummer,true);
		$criteria->compare('toevoeging',$this->toevoeging,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('plaats',$this->plaats,true);
		$criteria->compare('geboorteDatum',$this->geboorteDatum,true);
		$criteria->compare('telefoonNummer',$this->telefoonNummer);
		$criteria->compare('datumGewijzigd',$this->datumGewijzigd,true);
		$criteria->compare('statusAanmelding',$this->statusAanmelding);
		$criteria->compare('afdeling',$this->afdeling,true);
		$criteria->compare('redenLid',$this->redenLid,true);
		$criteria->compare('werkendLid',$this->werkendLid);
		$criteria->compare('ledenFunctie',$this->ledenFunctie,true);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	protected function afterFind ()
    {
		// convert to display format
        $this->geboorteDatum = strtotime ($this->geboorteDatum);
        $this->geboorteDag = date ('d', $this->geboorteDatum);
        $this->geboorteMaand = date ('m', $this->geboorteDatum);
        $this->geboorteJaar = date ('Y', $this->geboorteDatum);

        return parent::afterFind ();
    }

    protected function beforeValidate ()
    {
    	if($this->scenario == 'createLeden'){
			// convert to storage format
			$this->geboorteDatum = $this->geboorteJaar.'-'.$this->geboorteMaand.'-'.$this->geboorteDag;
		}

        return parent::beforeValidate();
    }
    protected function afterSave()
	{
		if($this->groepens <> null){
			if (LedenHasGroepen::model()->exists('leden_personeelsnummer=:personeelsnummer',
				array( ':personeelsnummer'=>$this->attributes['personeelsnummer'] )
			)) {
		        $criteria=new CDbCriteria;
	    		$criteria->condition='leden_personeelsnummer=:personeelsnummer';
				$criteria->params=array(':personeelsnummer'=>$this->attributes['personeelsnummer']);
				LedenHasGroepen::model()->deleteAll($criteria);
			}

			if(is_array($this->groepens)){
				foreach ($this->groepens as $groepId) {
					$lidGroep = new LedenHasGroepen;
					$lidGroep->leden_personeelsnummer = $this->attributes['personeelsnummer'];
					$lidGroep->groepen_id = $groepId;
					if (!$lidGroep->save()) 
						//Leden::model()->deleteAll('personeelsnummer= "'.$this->personeelsnummer.'"');
						print_r($lidGroep->errors);
				}
			}else{
				$lidGroep = new LedenHasGroepen;
				$lidGroep->leden_personeelsnummer = $this->attributes['personeelsnummer'];
				$lidGroep->groepen_id = $this->groepens;
				if (!$lidGroep->save()) 
					//Leden::model()->deleteAll('personeelsnummer= "'.$this->personeelsnummer.'"');
					print_r($lidGroep->errors);
			}
		}
		return parent::afterSave();
	}
    /*
        Validator function to be used from rules() 
    */
    public function validateDate( $attribute, $params )
    {
        if(
            ( $this->geboorteDag > 28 &&
                $this->geboorteMaand == 2 &&
                $this->geboorteJaar % 4 != 0 ) // 29/feb on a non-leap year
            ||
            ( $this->geboorteDag > 30 &&
                in_array( $this->geboorteMaand, array( 4,6,9,11 ) ) ) // 31 on a month with 30 days
            ||
            ( $this->geboorteDag > 29 && $this->geboorteMaand == 2 ) // later than 29/feb
            )
        {
            $this->addError( $attribute,'De geboortedatum is geen geldige datum.');
        }
    }

	//vergelijk functie. Dat de geboortedatum niet na vandaag ligt
	public function compareDateRange($attribute,$params) {
		if(!empty($this->attributes['geboorteDatum'])) {
			if(strtotime(date('d-m-Y')) < strtotime(($this->attributes['geboorteDatum']))) {
				$this->addError($attribute,'De geboortedatum ligt na de datum van vandaag.');
			}
		}

	}
	public function getPersoneelsnummerNaam() {
        return $this->personeelsnummer.' - '.$this->voorletters.' '.$this->voorvoegsel.' '.$this->achternaam;
	}
}