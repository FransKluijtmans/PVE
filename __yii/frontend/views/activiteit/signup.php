<?php
/* @var $this ActiviteitController */
/* @var $model Activiteit */

$this->breadcrumbs=array(
	'Activiteiten'=>array('index'),
	ucfirst($model->naam),
);

$this->menu=array(
	array('label'=>'List Activiteit', 'url'=>array('index')),
	array('label'=>'Manage Activiteit', 'url'=>array('admin')),
);
?>

<h1>Aanmelden voor <?php echo $model->naam ?></h1>

<?php echo $this->renderPartial('form/personal', array('model'=>$modelLeden));