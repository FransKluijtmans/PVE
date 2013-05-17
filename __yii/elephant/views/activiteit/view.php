<?php
$this->breadcrumbs=array(
	'Activiteits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Activiteit','url'=>array('index')),
	array('label'=>'Create Activiteit','url'=>array('create')),
	array('label'=>'Update Activiteit','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Activiteit','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Activiteit','url'=>array('admin')),
);
?>

<h1>View Activiteit #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'eindDatum',
		'aantalData',
		'aantalOpties',
		'eigenVervoer',
		'extraUitleg',
		'datumAangemaakt',
		'secties_id',
		'geschikt',
		'naam',
		'emailTekst',
		'content_id',
		'datumAangepast',
		'userAangepast',
		'userAangemaakt',
	),
)); ?>
