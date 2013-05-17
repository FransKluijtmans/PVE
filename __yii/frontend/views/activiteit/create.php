<?php
/* @var $this ActiviteitController */
/* @var $model Activiteit */

$this->breadcrumbs=array(
	'Activiteits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Activiteit', 'url'=>array('index')),
	array('label'=>'Manage Activiteit', 'url'=>array('admin')),
);
?>

<h1>Create Activiteit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>