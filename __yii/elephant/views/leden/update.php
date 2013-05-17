<?php
$this->breadcrumbs=array(
	'Ledens'=>array('index'),
	$model->personeelsnummer=>array('view','id'=>$model->personeelsnummer),
	'Update',
);

$this->menu=array(
	array('label'=>'Bekijk '.$model->personeelsnummer, 'url'=>array('view', 'id'=>$model->personeelsnummer), 'icon'=>'icon-eye-open icon-white'),
	array('label'=>'Nieuw lid', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
	array('label'=>'Leden overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
	)
?>

<h1>Aanpassen lid: <?php echo $model->personeelsnummer; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>