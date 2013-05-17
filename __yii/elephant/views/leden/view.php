<?php
$this->breadcrumbs=array(
	'Ledens'=>array('index'),
	$model->personeelsnummer,
);

$this->menu=array(
	array('label'=>'Aanpassen '.$model->personeelsnummer, 'url'=>array('update', 'id'=>$model->personeelsnummer), 'icon'=>'icon-pencil icon-white'),
	array('label'=>'Delete '.$model->personeelsnummer, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->personeelsnummer),'confirm'=>'Weet je zeker dat je de lid '.$model->personeelsnummer.' wil verwijderen?'), 'icon'=>'icon-minus icon-white'),
	array('label'=>'Nieuw lid', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Leden overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Lid: <?php echo $model->achternaam.' - '.$model->personeelsnummer; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>'condensed',
	'attributes'=>array(
		'personeelsnummer',
		array(
            'name'=>'Aanhef',
			'type' => 'raw',
			'value' => $model->aanhef == "M" ? "Dhr." : "Mevr.",
        ),
		'voorletters',
		'achternaam',
		array(
            'label'=>'Voorvoegsel',
            'value'=>$model->voorvoegsel,
			'visible'=>!empty($model->voorvoegsel),
        ),
		'emailAdres',
		'rekeningNummer',
		'straat',
		'huisNummer',
		array(
            'label'=>'Toevoeging',
            'value'=>$model->toevoeging,
			'visible'=>!empty($model->toevoeging),
        ),
		'postcode',
		'plaats',
		array(
            'label'=>'Geboortedatum',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->geboorteDatum,'long',false),
			'visible'=>!empty($model->geboorteDatum),
        ),
		'telefoonNummer',
		'afdeling',
		array(
            'name'=>'Werkend Lid',
			'type' => 'raw',
			'value' => $model->werkendLid ? "Ja" : "Nee",
        ),
		'ledenFunctie',
		array(
            'name'=>'Groepen',
			'type' => 'raw',
			'value'=>implode(", ",CHtml::listData(Groepen::model()->with(array('ledens' => array(
																									'join' => 'JOIN groepen ON groepen_id = groepen.id', 
																									'condition' => "leden_personeelsnummer = ".$model->personeelsnummer.""
																								)
																			)
																		)->
																	findAll(), 'id', 'naam')
													)
			),
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
	),
)); ?>
