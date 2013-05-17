<?php
$this->breadcrumbs=array(
	'Ledens'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nieuw lid', 'url'=>array('create'), 'icon'=>'icon-plus icon-white' ),
);

//$dataProvider=new CActiveDataProvider('Leden');
                

?>

<h1>Leden</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'leden-grid',
    'type'=>'striped condensed',
    'dataProvider' => $model->search(), 
    //'pagination'=>array('pageSize'=>25),    
	'filter'=>$model,
    'template'=>'{items}{pager}',
    'columns'=>array(
    	array(
            'name'=>'personeelsnummer', 'type'=>'raw', 'value'=>'CHtml::link($data->personeelsnummer, array("leden/view", "id"=>$data->personeelsnummer))',
        ),
		array(
            'name'=>'aanhef',
			'type' => 'raw',
			'value' => '$data->aanhef == "M" ? "Dhr." : "Mevr."',
        ),
		'voorletters',
		'voorvoegsel',
		//'achternaam',
		array(
            'name'=>'achternaam',
            'filter'=> $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name'=>'achternaam',
                //'model'=>$model,
                'attribute'=>'achternaam',
                //'sourceUrl'=>"/leden/autocompleteLastname/",
                'source'=>$this->createUrl('leden/autocompleteLastname'),
                'options'=>array(
                    'minLength'=>'2',
                     'showAnim'=>'fold',
                ),
                'htmlOptions'=>array(
                    'size'=>'36'
                ),
                ), true)
            //'type'=>'raw',
            //'value'=>'CHtml::link($data->achternaam, $this->grid->controller->createReturnableUrl("view",array("id"=>$data->personeelsnummer)))',
            /*'filter'=>$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$model,
                'attribute'=>'achternaam',
                'source'=>$this->createUrl('request/suggestLastname'),
                'options'=>array(
                    'focus'=>"js:function(event, ui) {
                        $('#".CHtml::activeId($model,'lastname')."').val(ui.item.value);
                    }",
                    'select'=>"js:function(event, ui) {
                        $.fn.yiiGridView.update('person-grid', {
                            data: $('#person-grid .filters input, #person-grid .filters select').serialize()
                        });
                    }"
                ),
            ),true),*/
        ),
		'emailAdres',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}{delete}',
            'htmlOptions'=>array('style'=>'width: 60px'),
			'deleteConfirmation'=>"js:'Weet je zeker dat je '+$(this).parent().parent().children(':nth-child(1)').text()+' wil verwijderen?'",
				'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
    ),
	 /*'afterAjaxUpdate'=>"function(){
	        jQuery('#".CHtml::activeId($model,'achternaam')."').autocomplete({
	            'delay':300,
	            'minLength':2,
	            'source':'".$this->createUrl('request/suggestLastname')."',
	            'focus':function(event, ui) {
	                $('#".CHtml::activeId($model,'achternaam')."').val(ui.item.value);
	            },
	            'select':function(event, ui) {
	                $.fn.yiiGridView.update('person-grid', {
	                    data: $('#person-grid .filters input, #person-grid .filters select').serialize()
	                });
	            }
	        });
	    }",*/
));