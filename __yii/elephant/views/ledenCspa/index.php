<?php
$this->breadcrumbs=array(
	'Leden Cspas',
);

$this->menu=array(
	array('label'=>'Create LedenCspa','url'=>array('create')),
	array('label'=>'Manage LedenCspa','url'=>array('admin')),
);
?>

<h1>Leden Cspas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
