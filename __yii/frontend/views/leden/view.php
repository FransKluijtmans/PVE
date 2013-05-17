<?php
/* @var $this LedenController */
/* @var $model Leden */

$this->breadcrumbs=array(
	'Ledens'=>array('index'),
	$model->personeelsnummer,
);

$this->menu=array(
	array('label'=>'List Leden', 'url'=>array('index')),
	array('label'=>'Create Leden', 'url'=>array('create')),
	array('label'=>'Update Leden', 'url'=>array('update', 'id'=>$model->personeelsnummer)),
	array('label'=>'Delete Leden', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->personeelsnummer),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Leden', 'url'=>array('admin')),
);
?>

<h1>View Leden #<?php echo $model->personeelsnummer; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'personeelsnummer',
		'aanhef',
		'voorletters',
		'achternaam',
		'voorvoegsel',
		'emailAdres',
		'rekeningNummer',
		'straat',
		'huisNummer',
		'toevoeging',
		'postcode',
		'plaats',
		'geboorteDatum',
		'telefoonNummer',
		'datumGewijzigd',
		'statusAanmelding',
		'afdeling',
		'redenLid',
		'werkendLid',
		'ledenFunctie',
		'datumAangemaakt',
		'datumAangepast',
		'userAangemaakt',
		'userAangepast',
	),
)); ?>
