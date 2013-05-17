<?php
$this->breadcrumbs=array(
	'Agendas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Agenda overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Create Agenda</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>