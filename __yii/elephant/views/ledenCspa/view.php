<?php
$this->breadcrumbs=array(
	'Leden Cspas'=>array('index'),
	$model->personeelsnummer,
);

$this->menu=array(
	array('label'=>'List LedenCspa','url'=>array('index')),
	array('label'=>'Create LedenCspa','url'=>array('create')),
	array('label'=>'Update LedenCspa','url'=>array('update','id'=>$model->personeelsnummer)),
	array('label'=>'Delete LedenCspa','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->personeelsnummer),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LedenCspa','url'=>array('admin')),
);
?>

<h1>View LedenCspa #<?php echo $model->personeelsnummer; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'personeelsnummer',
		'aanhef',
		'voorletters',
		'achternaam',
		'voorvoegsel',
		'tweede_achternaam',
		'tweede_voorvoegsel',
		'adres',
		'postcode',
		'plaats',
		'geboortedatum',
		'bijdrage',
		'pv',
	),
)); ?>
