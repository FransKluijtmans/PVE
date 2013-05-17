<?php
$this->breadcrumbs=array(
	'Groepens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Groepen overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Create Groepen</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>