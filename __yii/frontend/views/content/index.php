<?php
/* @var $this ContentController */

$this->breadcrumbs=array(
	'Content',
);
?>
<h1>Nieuws</h1>

<?php $this->widget('frontend.components.MListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'itemsTagName'=>'ul',
			'itemsCssClass'=>'overviewList',
			'template' => '{items}{pager}',
			'pager'=>array('class'=>'TbPager'),
		)); ?>