<?php
$this->breadcrumbs=array(
	'Activiteits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Activiteit','url'=>array('index')),
	array('label'=>'Create Activiteit','url'=>array('create')),
	array('label'=>'View Activiteit','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Activiteit','url'=>array('admin')),
);
?>

<h1>Update Activiteit <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>