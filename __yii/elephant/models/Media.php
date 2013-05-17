<?php

/**
 * This is the model class for table "media".
 *
 * The followings are the available columns in table 'media':
 * @property integer $id
 * @property string $naam
 * @property string $locatie
 * @property string $title
 * @property string $alt
 * @property integer $height
 * @property integer $width
 * @property string $datumAangemaakt
 * @property integer $tbl_media_types_mediaTypesId
 * @property string $datumAangepast
 * @property string $userAangepast
 * @property string $userAangemaakt
 *
 * The followings are the available model relations:
 * @property Leden $userAangepast0
 * @property Leden $userAangemaakt0
 * @property MediaTypes $tblMediaTypesMediaTypes
 * @property Content[] $contents
 * @property Tags[] $tags
 */
class Media extends CActiveRecord
{
	public $files;
	public $extension;
	public $curName;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Media the static model class
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
		return 'media';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('naam,  datumAangemaakt,  userAangemaakt, alt, title', 'required'),
			array('files', 'file', 'allowEmpty' => false, 'types'=>'jpg,gif,png,pdf,doc,xls,xlsx', 'on' => 'create'),
			//array('naam, locatie, datumAangemaakt, tbl_media_types_mediaTypesId, userAangemaakt', 'required'),
			array('height, width, tbl_media_types_mediaTypesId', 'numerical', 'integerOnly'=>true),
			array('naam, locatie, title, alt', 'length', 'max'=>45),
			array('userAangepast, userAangemaakt', 'length', 'max'=>15),
			array('datumAangepast', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, naam, locatie, title, alt, height, width, datumAangemaakt, tbl_media_types_mediaTypesId, datumAangepast, userAangepast, userAangemaakt, extension', 'safe', 'on'=>'search'),
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
			'usersAangepast' => array(self::BELONGS_TO, 'Leden', 'userAangepast'),
			'usersAangemaakt' => array(self::BELONGS_TO, 'Leden', 'userAangemaakt'),
			'tblMediaTypesMediaTypes' => array(self::BELONGS_TO, 'MediaTypes', 'tbl_media_types_mediaTypesId'),
			'contents' => array(self::MANY_MANY, 'Content', 'media_has_content(media_id, nieuws_id)'),
			'tags' => array(self::MANY_MANY, 'Tags', 'media_has_tags(media_id, tags_id)'),
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
			'locatie' => 'Locatie',
			'title' => 'Titel',
			'alt' => 'Alt',
			'height' => 'Hoogte',
			'width' => 'Breedte',
			'datumAangemaakt' => 'Datum aangemaakt',
			'tbl_media_types_mediaTypesId' => 'Tbl Media Types Media Types',
			'datumAangepast' => 'Datum aangepast',
			'userAangepast' => 'Gebruiker aangepast',
			'userAangemaakt' => 'Gebruiker aangemaakt',
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
		$criteria->compare('locatie',$this->locatie,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('height',$this->height);
		$criteria->compare('width',$this->width);
		$criteria->compare('datumAangemaakt',$this->datumAangemaakt,true);
		$criteria->compare('tbl_media_types_mediaTypesId',$this->tbl_media_types_mediaTypesId);
		$criteria->compare('datumAangepast',$this->datumAangepast,true);
		$criteria->compare('userAangepast',$this->userAangepast,true);
		$criteria->compare('userAangemaakt',$this->userAangemaakt,true);
		//extra kolom uit de tblMediaTypesMediaTypes tabel toevoegen
		$criteria->with = array( 'tblMediaTypesMediaTypes' );
		$criteria->compare( 'extension', $this->extension,true );

		$sort = new CSort();
		$sort->attributes = array(
			'extension'=>array(
				'asc'=>'tblMediaTypesMediaTypes.extension',
				'desc'=>'tblMediaTypesMediaTypes.extension desc',
			), '*',
		);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
    		'sort'=>$sort,
		));
	}
	protected function beforeSave()
	{
		if ($this->isNewRecord){
	        $criteria=new CDbCriteria;
	   		$criteria->select='id';
	   		$criteria->condition='extension=:extension';
			$criteria->params=array(':extension'=>$this->tbl_media_types_mediaTypesId);
			$result = MediaTypes::model()->find($criteria);
			if(!is_null($result)){
				$this->tbl_media_types_mediaTypesId = $result->id;
			}
		}

		return parent::beforeSave();
	}
	protected function beforeValidate()
	{
        $criteria=new CDbCriteria;
   		$criteria->select='id';
   		$criteria->condition='extension=:extension';
		$criteria->params=array(':extension'=>$this->tbl_media_types_mediaTypesId);
		$result = MediaTypes::model()->find($criteria);
		if(!is_null($result)){
			$this->tbl_media_types_mediaTypesId = $result->id;
		}
		return parent::beforeValidate();
	}
	public function afterSave() {
	    if (!$this->isNewRecord){
	    	if(file_exists(Yii::getPathOfAlias('webroot').'/../files/image/'.$this->curName.'.'.$this->tblMediaTypesMediaTypes->extension)){
	    		rename(Yii::getPathOfAlias('webroot').'/../files/image/'.$this->curName.'.'.$this->tblMediaTypesMediaTypes->extension, Yii::getPathOfAlias('webroot').'/../files/image/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
	    		rename(Yii::getPathOfAlias('webroot').'/../files/image/original/'.$this->curName.'.'.$this->tblMediaTypesMediaTypes->extension, Yii::getPathOfAlias('webroot').'/../files/image/original/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
	    		rename(Yii::getPathOfAlias('webroot').'/../files/image/thumb/'.$this->curName.'.'.$this->tblMediaTypesMediaTypes->extension, Yii::getPathOfAlias('webroot').'/../files/image/thumb/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
			}elseif(file_exists(Yii::getPathOfAlias('webroot').'/../files/application/'.$this->curName.'.'.$this->tblMediaTypesMediaTypes->extension)){
				rename(Yii::getPathOfAlias('webroot').'/../files/application/'.$this->curName.'.'.$this->tblMediaTypesMediaTypes->extension, Yii::getPathOfAlias('webroot').'/../files/application/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
			}else{
				rename(Yii::getPathOfAlias('webroot').'/../files/video/'.$this->curName.'.'.$this->tblMediaTypesMediaTypes->extension, Yii::getPathOfAlias('webroot').'/../files/video/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
			}
	    }
	    parent::afterSave( );
	}
	protected function beforeDelete()
	{
        //chmod('../files/images/', 0777);
		if(Media::model()->exists('id ='.$this->id)){
			if(file_exists(Yii::getPathOfAlias('webroot').'/../files/image/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension)){
				unlink(Yii::getPathOfAlias('webroot').'/../files/image/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
				unlink(Yii::getPathOfAlias('webroot').'/../files/image/original/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
				unlink(Yii::getPathOfAlias('webroot').'/../files/image/thumb/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
			}elseif(file_exists(Yii::getPathOfAlias('webroot').'/../files/application/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension)){
				unlink(Yii::getPathOfAlias('webroot').'/../files/application/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
			}else{
				unlink(Yii::getPathOfAlias('webroot').'/../files/video/'.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension);
			}
		}
		//chmod('../files/images/', 0755);

		return parent::beforeDelete();
	}
	public function gridviewFormat($type) {
		if(substr($type, 0, 5) == 'image'){
			
			return html_entity_decode(CHtml::image('..'.$this->locatie.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension, $this->alt, array('width'=>'640', 'height' => floor((640/$this->width)*$this->height))));
		}else{
			return CHtml::link($this->title,'..'.$this->locatie.$this->naam.'.'.$this->tblMediaTypesMediaTypes->extension, array('target'=>'_blank'));
		}
	}
 
	////////////////////////////////////////////////////////////////////upload
	/*public function afterSave( ) {
	    $this->addFiles( );
	    parent::afterSave( );
	}
	public function addFiles( ) {
	    //If we have pending images
	    if( Yii::app( )->user->hasState( 'images' ) ) {
	        $userImages = Yii::app( )->user->getState( 'images' );
	        //Resolve the final path for our images
	        $path = Yii::app( )->getBasePath( )."/../files/{$this->id}/";
	        //Create the folder and give permissions if it doesnt exists
	        if( !is_dir( $path ) ) {
	            mkdir( $path );
	            chmod( $path, 0777 );
	        }
	 
	        //Now lets create the corresponding models and move the files
	        foreach( $userImages as $image ) {
	            if( is_file( $image["path"] ) ) {
	                if( rename( $image["path"], $path.$image["filename"] ) ) {
	                    chmod( $path.$image["filename"], 0777 );
	                    $img = new Image( );
	                    $img->size = $image["size"];
	                    $img->mime = $image["mime"];
	                    $img->name = $image["name"];
	                    $img->source = "/files/{$this->id}/".$image["filename"];
	                    $img->somemodel_id = $this->id;
	                    if( !$img->save( ) ) {
	                        //Its always good to log something
	                        Yii::log( "Could not save Image:\n".CVarDumper::dumpAsString( 
	                            $img->getErrors( ) ), CLogger::LEVEL_ERROR );
	                        //this exception will rollback the transaction
	                        throw new Exception( 'Could not save Image');
	                    }
	                }
	            } else {
	                //You can also throw an execption here to rollback the transaction
	                Yii::log( $image["path"]." is not a file", CLogger::LEVEL_WARNING );
	            }
	        }
	        //Clear the user's session
	        Yii::app( )->user->setState( 'images', null );
	    }
	}*/
}