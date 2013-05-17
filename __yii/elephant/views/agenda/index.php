<?php
$this->breadcrumbs=array(
	'Agendas',
);

$this->menu=array(
	array('label'=>'Create Agenda','url'=>array('create')),
	array('label'=>'Manage Agenda','url'=>array('admin')),
);
?>

<h1>Agendas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
