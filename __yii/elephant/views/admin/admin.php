<?php
$this->breadcrumbs=array(
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuwe admin', 'url'=>array('create'), 'icon'=>'icon-plus icon-white'),
);
?>

<h1>Administrators</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'admin-grid',
    'type'=>'striped condensed',
    'dataProvider'=>$model->search(),
	'filter'=>$model,
    'template'=>"{items}",
	//'ajaxUpdate'=>true,
    'columns'=>array(
		array(
			'name'=>'achternaam', 
			'type'=>'raw', 
			'value'=>'CHtml::link($data->ledenPersoneelsnummer->achternaam, array("admin/view", "id"=>$data->id))',
			),
		'leden_personeelsnummer',
		array( 	
			'name' => 'functiesOmschrijving',
    		'header'=>'Functie',
     		'value' => '$data->functies->omschrijving',
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