<h1>CSPA - Nieuwe leden</h1>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'leden-cspa-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'primary',
    'label'=>'Maken',
    'icon'=>'arrow-right white',
    'loadingText'=>'verwerken...',
    'htmlOptions'=>array('id'=>'buttonStateful'),
));
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'link',
    'label'=>'Annuleren',
    'url'=>Yii::app()->request->urlReferrer,
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'leden-cspa-grid',
    'type'=>'striped condensed hover',
    //'selectableRows' => 2,
    'dataProvider' => $dataProvider,        
	'filter'=>$model,
    'template'=>'{pager}{items}{pager}',
    'emptyText' => 'Geen nieuwe leden gevonden.',
    'columns'=>array(
    	//array(
			//'header' => 'Timeliness',
			//'type' => 'raw',
			//'value' => "$form->radioButtonListRow($model,'pv',array('PVU'))", // add this code
            //'separator'=>'',
    	//),
    	 array(
            'header'=>'PVE',
            'type'=>'raw',
            'value'=>'CHtml::radioButton("pv[$data[personeelsnummer]]", false, array("value"=>"pve"))',
            'htmlOptions'=>array("width"=>"50px"),
        ),
    	 array(
            'header'=>'PVU',
            'type'=>'raw',
            'value'=>'CHtml::radioButton("pv[$data[personeelsnummer]]",false,array("value"=>"pvu"))',
            'htmlOptions'=>array("width"=>"50px"),
        ),
		'personeelsnummer',
		array(
            'name'=>'aanhef',
			'type' => 'raw',
			//'value' => '$data->aanhef',
        ),
		'voorletters',
		array(
            'name'=>'achternaam',
            'type'=>'raw',
            'value'=>'$data["voorvoegsel"]." ".$data["achternaam"]." ".$data["tweede_voorvoegsel"]." ".$data["tweede_achternaam"]',
        ),
    ),
));

$this->endWidget();