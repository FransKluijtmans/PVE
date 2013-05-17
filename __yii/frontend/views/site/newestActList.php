 <?php $this->widget('frontend.components.MListView', array(
 	'dataProvider'=>$actdataProvider,
 	'itemView'=>'views/_actNewestListView',
 	'itemsTagName'=>'ul',
 	'itemsCssClass'=>'actOverviewList',
 	'template' => '{items}',
)); ?>	
				