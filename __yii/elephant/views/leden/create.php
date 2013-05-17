<?php
$this->breadcrumbs=array(
	'Ledens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Leden overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Create Leden</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>