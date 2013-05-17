<?php
$this->breadcrumbs=array(
	'Groepens'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuwe groep', 'url'=>array('create'), 'icon'=>'icon-plus icon-white'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('groepen-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Groepen</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'groepen-grid',
	'type'=>'striped condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{items}",
	'columns'=>array(
		array(
				'name'=>'naam', 
				'type'=>'raw', 
				'value'=>'CHtml::link($data->naam, array("groepen/view", "id"=>$data->id))',
			),
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 60px'),
			'deleteConfirmation'=>"js:'Weet je zeker dat je '+$(this).parent().parent().children(':nth-child(1)').text()+' wil verwijderen?'",
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
	),
));