<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Bekijk '.$model->titel, 'url'=>array('view', 'id'=>$model->id), 'icon'=>'icon-eye-open icon-white'),
	array('label'=>'Nieuw artikel', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Artikelen overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ), 
);
?>

<h1>Update Content <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>