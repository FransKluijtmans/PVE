<?php
$this->breadcrumbs=array(
	'Activiteits',
);

$this->menu=array(
	array('label'=>'Create Activiteit','url'=>array('create')),
	array('label'=>'Manage Activiteit','url'=>array('admin')),
);
?>

<h1>Activiteits</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
