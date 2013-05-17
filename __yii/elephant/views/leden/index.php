<?php
$this->breadcrumbs=array(
	'Ledens',
);

$this->menu=array(
	array('label'=>'Create Leden', 'url'=>array('create')),
	array('label'=>'Manage Leden', 'url'=>array('admin')),
);
?>

<h1>Ledens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
