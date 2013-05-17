<?php
$this->breadcrumbs=array(
	'Agendas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuw agenda item', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
);
?>

<h1>Agenda</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'agenda-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
            'name'=>'omschrijving', 'type'=>'raw', 'value'=>'CHtml::link($data->omschrijving, array("agenda/view", "id"=>$data->id))',
        ),
		array(      
            'name'=>'datum',
            'value'=>'Yii::app()->dateFormatter->formatDateTime($data->datum,"long",NULL)',
        ),
		array(      
            'name'=>'datumAangemaakt',
            'value'=>'Yii::app()->dateFormatter->formatDateTime($data->datumAangemaakt,"long",NULL)',
        ),
		//'datumAangepast',
		//'secties_id',
        array( 'name'=>'naam', 'value'=>'$data->secties->naam' ),
		/*
		'userAangemaakt',
		'userAangepast',
		*/
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 60px'),
			'deleteConfirmation'=>"js:'Weet je zeker dat je het artikel '+$(this).parent().parent().children(':nth-child(1)').text()+' wil verwijderen?'",
				'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
	),
)); ?>