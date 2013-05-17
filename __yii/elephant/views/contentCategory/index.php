<?php
$this->breadcrumbs=array(
	'Content Categories',
);

$this->menu=array(
	array('label'=>'Create ContentCategory','url'=>array('create')),
	array('label'=>'Manage ContentCategory','url'=>array('admin')),
);
?>

<h1>Content Categories</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
