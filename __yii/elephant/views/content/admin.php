<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuw artikel', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
);
?>

<h1>Artikelen</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'content-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
            'name'=>'titel', 'type'=>'raw', 'value'=>'CHtml::link($data->titel, array("content/view", "id"=>$data->id))',
        ),
		/*'content',
		'datumAangemaakt',
		'datumAangepast',
		'userAangepast',
		'icoonId',
		'userAangemaakt',
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
