<?php
$this->breadcrumbs=array(
	'Secties',
);

$this->menu=array(
	array('label'=>'Create Secties', 'url'=>array('create')),
	array('label'=>'Manage Secties', 'url'=>array('admin')),
);
?>

<h1>Secties</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
