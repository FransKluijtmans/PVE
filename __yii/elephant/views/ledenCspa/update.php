<?php
$this->breadcrumbs=array(
	'Leden Cspas'=>array('index'),
	$model->personeelsnummer=>array('view','id'=>$model->personeelsnummer),
	'Update',
);

$this->menu=array(
	array('label'=>'List LedenCspa','url'=>array('index')),
	array('label'=>'Create LedenCspa','url'=>array('create')),
	array('label'=>'View LedenCspa','url'=>array('view','id'=>$model->personeelsnummer)),
	array('label'=>'Manage LedenCspa','url'=>array('admin')),
);
?>

<h1>Update LedenCspa <?php echo $model->personeelsnummer; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>