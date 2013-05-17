<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Aanpassen '.$model->ledenPersoneelsnummer->achternaam, 'url'=>array('update', 'id'=>$model->id), 'icon'=>'icon-pencil icon-white'),
	array('label'=>'Delete '.$model->ledenPersoneelsnummer->achternaam, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete '.$model->ledenPersoneelsnummer->achternaam.'?'), 'icon'=>'icon-minus icon-white'),
	array('label'=>'Nieuwe admin', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Admin overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Admin - <?php echo $model->ledenPersoneelsnummer->achternaam; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>'condensed',
	'attributes'=>array(
		array(
            'name'=>'initieelGewijzigd',
			'type' => 'raw',
			'value' => $model->initieelGewijzigd ? "Ja" : "Nee",
        ),
		'leden_personeelsnummer',
		'functies.omschrijving',
	),
));