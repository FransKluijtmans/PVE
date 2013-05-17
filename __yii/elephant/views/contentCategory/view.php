<?php
$this->breadcrumbs=array(
	'Content Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Aanpassen '.$model->omschrijving, 'url'=>array('update', 'id'=>$model->id), 'icon'=>'icon-pencil icon-white'),
	array('label'=>'Delete '.$model->omschrijving, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Weet je zeker dat je de categorie '.$model->omschrijving.' wil verwijderen?'), 'icon'=>'icon-minus icon-white'),
	array('label'=>'Nieuwe categorie', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Categorieen overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>View ContentCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'omschrijving',
		array(
            'label'=>'Datum - aangemaakt',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->datumAangemaakt,'long','medium'),
        ),
		array(
            'label'=>'Naam - aangemaakt',
            'value'=>  CHtml::encode($model->usersAangemaakt->voorletters).' '.CHtml::encode($model->usersAangemaakt->voorvoegsel).' '.CHtml::encode($model->usersAangemaakt->achternaam.' - '.$model->usersAangemaakt->personeelsnummer),
        ),
        array(
            'label'=>'Datum - aangepast',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->datumAangepast,'long','medium'),
			'visible'=>!empty($model->datumAangepast),
        ),
		array(
            'label'=>'Naam - aangepast',
            'value'=>  $model->userAangepast ? CHtml::encode($model->usersAangepast->voorletters).' '.CHtml::encode($model->usersAangepast->voorvoegsel).' '.CHtml::encode($model->usersAangepast->achternaam.' - '.$model->usersAangepast->personeelsnummer) : NULL,
            'visible'=>!empty($model->userAangepast),
        ),
	),
)); ?>
