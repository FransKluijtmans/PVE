<?php
/* @var $this SectiesController */
/* @var $model Secties */

$this->breadcrumbs=array(
	'Secties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Secties', 'url'=>array('index')),
	array('label'=>'Create Secties', 'url'=>array('create')),
	array('label'=>'View Secties', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Secties', 'url'=>array('admin')),
);
?>

<h1>Update Secties <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>