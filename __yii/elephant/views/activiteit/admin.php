<?php
$this->breadcrumbs=array(
	'Activiteits'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuwe activiteit', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
);
?>

<h1>Activiteiten</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'activiteit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'naam',
			'type'=>'raw',
			'value'=>'CHtml::link($data->naam, array("/activiteit/view", "id"=>$data->id))',
		),
		array(      
            'name'=>'eindDatum',
            'value'=>'Yii::app()->dateFormatter->formatDateTime($data->eindDatum,"long",NULL)',
        ),
		'geschikt',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 60px'),
			'deleteConfirmation'=>"js:'Weet je zeker dat je '+$(this).parent().parent().children(':nth-child(1)').text()+' wil verwijderen?'",
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
	),
));