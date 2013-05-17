<?php
$this->breadcrumbs=array(
	'Groepens',
);

$this->menu=array(
	array('label'=>'Create Groepen', 'url'=>array('create')),
	array('label'=>'Manage Groepen', 'url'=>array('admin')),
);
?>

<h1>Groepens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
