<?php
$this->breadcrumbs=array(
	'Leden Cspas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LedenCspa','url'=>array('index')),
	array('label'=>'Manage LedenCspa','url'=>array('admin')),
);
?>

<h1>Create LedenCspa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>