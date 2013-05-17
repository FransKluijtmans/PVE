<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Bekijk '.$model->ledenPersoneelsnummer->achternaam, 'url'=>array('view', 'id'=>$model->id), 'icon'=>'icon-eye-open icon-white'),
	array('label'=>'Nieuwe admin', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Admin overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ), 
);
?>

<h1>Aanpassen - <?php echo $model->ledenPersoneelsnummer->achternaam; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model'=>$model)); ?>