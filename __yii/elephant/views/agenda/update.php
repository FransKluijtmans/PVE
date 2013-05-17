<?php
$this->breadcrumbs=array(
	'Agendas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Bekijk '.$model->omschrijving, 'url'=>array('view', 'id'=>$model->id), 'icon'=>'icon-eye-open icon-white'),
	array('label'=>'Nieuw agenda item', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Agenda overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ), 
	)
?>

<h1>Update Agenda <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>