<?php
$this->breadcrumbs=array(
	'Medias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Media overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
    
);
?>

<h1>Nieuwe media</h1>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Enkele upload', 'url'=>'index.php?r=media/create', 'active'=>true),
        array('label'=>'Meerdere uploads', 'url'=>'index.php?r=media/createmulti'),
    ),
)); ?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>