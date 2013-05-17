<?php
$this->breadcrumbs=array(
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuwe sectie', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
);
?>

<h1>Secties</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'dataProvider'=>$model->search(),
	'filter'=>$model,
    'template'=>"{items}",
    'columns'=>array(
        array(
            'name'=>'naam', 'type'=>'raw', 'value'=>'CHtml::link($data->naam, array("secties/view", "id"=>$data->id))',
        ),
		'email',
		//'competitieModule',
		 array(
            'name'=>'competitieModule',
			'type' => 'html',
			'value' => 'CHtml::tag("span", array("class" => $data->competitieModule ? "icon-ok" : "icon-remove"), "")',
            'htmlOptions'=>array("width"=>"50px"),
			'filter' => array('' => '', 0 => 'Nee', 1 => 'Ja'),  
        ),
		/*
		'functies_id',
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