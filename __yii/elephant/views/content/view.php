<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Aanpassen '.$model->titel, 'url'=>array('update', 'id'=>$model->id), 'icon'=>'icon-pencil icon-white'),
	array('label'=>'Delete '.$model->titel, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Weet je zeker dat je het artikel '.$model->titel.' wil verwijderen?'), 'icon'=>'icon-minus icon-white'),
	array('label'=>'Nieuw artikel', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Artikel overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
	)
?>

<h1>Artikel - <?php echo $model->titel; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'icoonId',
		array(
            'label'=>'Datum - aangemaakt',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->datumAangemaakt,'long','medium'),
			'visible'=>!empty($model->datumAangemaakt),
        ),
        array(
            'label'=>'Naam - aangemaakt',
            'value'=>CHtml::encode($model->usersAangemaakt->voorletters).' '.CHtml::encode($model->usersAangemaakt->voorvoegsel).' '.CHtml::encode($model->usersAangemaakt->achternaam.' - '.$model->usersAangemaakt->personeelsnummer),
			'visible'=>!empty($model->datumAangemaakt),
        ),
		array(
            'label'=>'Datum - aangepast',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->datumAangepast,'long','medium'),
			'visible'=>!empty($model->datumAangepast),
        ),
        array(
            'label'=>'Naam - aangepast',
            'value'=> $model->userAangepast ? CHtml::encode($model->usersAangepast->voorletters).' '.CHtml::encode($model->usersAangepast->voorvoegsel).' '.CHtml::encode($model->usersAangepast->achternaam.' - '.$model->usersAangepast->personeelsnummer) : NULL,
			'visible'=>!empty($model->userAangepast),
        ),
		'titel',
		array(
            'name'=>'content',
			'type' => 'html',
			'value' => $model->content
        ),
	),
)); ?>
