<?php
$this->breadcrumbs=array(
	'Secties'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Sectie overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Maak een sectie.</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>