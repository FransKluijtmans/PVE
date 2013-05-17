<?php
$this->breadcrumbs=array(
	'Secties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array( 
	array('label'=>'Bekijk '.$model->naam, 'url'=>array('view', 'id'=>$model->id), 'icon'=>'icon-eye-open icon-white'),
	array('label'=>'Nieuwe sectie', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Sectie overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ), 
);
?>

<h1>Aanpassen sectie: <?php echo $model->naam; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>