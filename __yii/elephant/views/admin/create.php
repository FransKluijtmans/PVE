<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Admin overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Nieuwe admin.</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>