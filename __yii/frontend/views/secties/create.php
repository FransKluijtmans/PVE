<?php
/* @var $this SectiesController */
/* @var $model Secties */

$this->breadcrumbs=array(
	'Secties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Secties', 'url'=>array('index')),
	array('label'=>'Manage Secties', 'url'=>array('admin')),
);
?>

<h1>Create Secties</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>