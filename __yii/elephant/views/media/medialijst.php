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
        array('label'=>'Gallerij', 'url'=>'index.php?r=media'),
        array('label'=>'Lijst', 'url'=>'index.php?r=media/medialijst', 'active'=>true),
    ),
)); ?>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'media-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'title', 'type'=>'raw', 'value'=>'CHtml::link($data->title, array("media/view", "id"=>$data->id))',
        ),
		'naam',
		'height',
		'width',
		array( 'name'=>'extension', 'value'=>'$data->tblMediaTypesMediaTypes->extension' ),
		/*
		'datumAangemaakt',
		'tbl_media_types_mediaTypesId',
		'datumAangepast',
		'userAangepast',
		'userAangemaakt',
		*/
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 60px'),
			'deleteConfirmation'=>"js:'Weet je zeker dat je '+$(this).parent().parent().children(':nth-child(1)').text()+' wil verwijderen?'",
				'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
	),
));