<?php
$this->breadcrumbs=array(
	'Medias'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuwe media', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
  
);
?>

<h1>Media</h1>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Gallerij', 'url'=>'index.php?r=media', 'active'=>true),
        array('label'=>'Lijst', 'url'=>'index.php?r=media/medialijst'),
    ),
)); ?>
<div class="row-fluid">
  <div class="span9">
<?php /*$this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$model->search(),
        'itemView'=>'_view',
        'template'=>'{sorter}<br />{pager}{items}{pager}',
        'enableSorting' => true,
        'sortableAttributes'=>array(
            'name'=>'By name',
        ),
));*/
$this->widget('bootstrap.widgets.TbThumbnails', array(
    'dataProvider'=>$model->search(),
    'template'=>"{items}\n{pager}",
    'itemView'=>'_thumb',
)); ?>
</div>
<div class="span3" id="sidebarMedia">
  <?php //echo $this->renderPartial('_formUpdate',array('model'=>$model)); ?>
  <?php //$this->renderPartial('_ajaxContent', array('myValue'=>$myValue)); ?>
  </div>
</div>