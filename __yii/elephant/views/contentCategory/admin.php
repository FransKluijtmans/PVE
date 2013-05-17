<?php
$this->breadcrumbs=array(
	'Content Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuwe categorie', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
);
?>

<h1>Categorieen - wordt gebruikt voor artikelen</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'content-category-grid',
    'type'=>'striped condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
            'name'=>'omschrijving', 'type'=>'raw', 'value'=>'CHtml::link($data->omschrijving, array("contentcategory/view", "id"=>$data->id))',
        ),
		'datumAangemaakt',
		//'datumAangepast',
		'userAangemaakt',
		//'userAangepast',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 60px'),
			'deleteConfirmation'=>"js:'Weet je zeker dat je '+$(this).parent().parent().children(':nth-child(1)').text()+' wil verwijderen?'",
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
    ),
));