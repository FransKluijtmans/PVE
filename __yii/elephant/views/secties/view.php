<?php
$this->breadcrumbs=array(
	'Secties'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Aanpassen '.$model->naam, 'url'=>array('update', 'id'=>$model->id), 'icon'=>'icon-pencil icon-white'),
	array('label'=>'Delete '.$model->naam, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Weet je zeker dat je de sectie '.$model->naam.' wil verwijderen?'), 'icon'=>'icon-minus icon-white'),
	array('label'=>'Nieuwe sectie', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Sectie overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Sectie: <?php echo $model->naam ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>'condensed',
	'attributes'=>array(
		'naam',
		'email',
		array(
            'name'=>'competitieModule',
			'type' => 'raw',
			'value' => $model->competitieModule ? "Nee" : "Ja",
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
            'value'=> $model->userAangepast ? CHtml::encode($model->userAangepast->voorletters).' '.CHtml::encode($model->userAangepast->voorvoegsel).' '.CHtml::encode($model->userAangepast->achternaam.' - '.$model->userAangepast->personeelsnummer) : NULL,
			'visible'=>!empty($model->userAangepast),
        ),
        array(
            'name'=>'info',
			'type' => 'html',
			'value' => $model->info,
        ),
	),
)); ?>