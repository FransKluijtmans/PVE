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
        array('label'=>'Enkele upload', 'url'=>'index.php?r=media/create'),
        array('label'=>'Meerdere uploads', 'url'=>'index.php?r=media/createmulti', 'active'=>true),
    ),
)); ?>
<?php //echo $this->renderPartial('_formMulti', array('model'=>$model)); ?>
<div id="dropzone" class="fade well"><span>Sleep je bestanden hierheen.</span></div>
<?php
        $this->widget('xupload.XUpload', array(
            'url' => Yii::app()->createUrl("media/upload", array("parent_id" => 1)),
            'model' => $model,
            'attribute' => 'file',
            'multiple' => true,
            'options' => array(
            ),
        ));
        echo Yii::getPathOfAlias('webroot').'../files/uploads';
        ?>