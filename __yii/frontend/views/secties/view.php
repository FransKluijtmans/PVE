<?php
/* @var $this SectiesController */
/* @var $model Secties */

$this->breadcrumbs=array(
	'Secties'=>array('index'),
	$model->naam,
);

$this->menu=array(
	array('label'=>'List Secties', 'url'=>array('index')),
	array('label'=>'Create Secties', 'url'=>array('create')),
	array('label'=>'Update Secties', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Secties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Secties', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->naam; ?> sectie</h1>
<p><?php echo $model->info; ?></p>
