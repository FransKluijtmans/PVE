<?php
$this->breadcrumbs=array(
	'Medias'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Aanpassen '.$model->title, 'url'=>array('update', 'id'=>$model->id), 'icon'=>'icon-pencil icon-white'),
	array('label'=>'Delete '.$model->title, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Weet je zeker dat je het media item '.$model->title.' wil verwijderen?'), 'icon'=>'icon-minus icon-white'),
	array('label'=>'Nieuwe media', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Media overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ), 
);
?>

<h1>Media - <?php echo $model->title.' - '.$model->naam.'.'.$model->tblMediaTypesMediaTypes->extension; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'naam',
		'title',
		'alt',
		array(
			'label'=> 'Breedte',
            'value'=> $model->width,
			'visible'=>!empty($model->width),
        ),
        array(
        	'label'=> 'Hoogte',
            'value'=> $model->height,
			'visible'=>!empty($model->height),
        ),
		array(
            'label'=>'Soort',
            'value'=>CHtml::encode($model->tblMediaTypesMediaTypes->omschrijving),
        ),
		array(
            'label'=>'Datum - aangemaakt',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->datumAangemaakt,'long','medium'),
        ),
		array(
            'label'=>'Naam - aangemaakt',
            'value'=>CHtml::encode($model->usersAangemaakt->voorletters).' '.CHtml::encode($model->usersAangemaakt->voorvoegsel).' '.CHtml::encode($model->usersAangemaakt->achternaam.' - '.$model->usersAangemaakt->personeelsnummer),
        ),
		array(
            'label'=>'Datum - aangepast',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->datumAangepast,'long','medium'),
			'visible'=>!empty($model->datumAangepast),
        ),
		array(
            'label'=>'Naam - aangepast',
            'value'=>CHtml::encode($model->usersAangepast->voorletters).' '.CHtml::encode($model->usersAangepast->voorvoegsel).' '.CHtml::encode($model->usersAangepast->achternaam.' - '.$model->usersAangepast->personeelsnummer),
			'visible'=>!empty($model->datumAangepast),
        ),
        array(
            'name'=>'Voorbeeld',
			'type' => 'raw',
			'value' => $model->gridviewFormat($model->tblMediaTypesMediaTypes->type),
        ),
	),
));  ?>
