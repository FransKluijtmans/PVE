<?php
$this->breadcrumbs=array(
	'Medias'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Bekijk '.$model->title, 'url'=>array('view', 'id'=>$model->id), 'icon'=>'icon-eye-open icon-white'),
	array('label'=>'Nieuwe media', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Media overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
	);
?>

<h1>Aanpassen <?php echo $model->title.' - '.$model->naam.'.'.$model->tblMediaTypesMediaTypes->extension; ?></h1>

<?php echo $this->renderPartial('_formUpdate',array('model'=>$model)); ?>