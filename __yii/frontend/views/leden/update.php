<?php
/* @var $this LedenController */
/* @var $model Leden */

$this->breadcrumbs=array(
	'Service'=>array('index'),
	'NAW wijzigen',
);

$this->menu=array(
	array('label'=>'List Leden', 'url'=>array('index')),
	array('label'=>'Create Leden', 'url'=>array('create')),
	array('label'=>'View Leden', 'url'=>array('view', 'id'=>$model->personeelsnummer)),
	array('label'=>'Manage Leden', 'url'=>array('admin')),
);
?>

<h1>NAW wijzigen</h1>

<?php echo $this->renderPartial('//leden/_form', array('model'=>$model)); ?>