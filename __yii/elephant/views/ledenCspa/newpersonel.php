<h1>CSPA - nieuw personeel</h1>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'leden-cspa-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'primary',
    'label'=>'Toevoegen',
    'icon'=>'icon-plus icon-white',
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
    //'afterAjaxUpdate'=>'js:function() {myLigasListUpdated();}',
    'columns'=>array(
    	//array(
			//'header' => 'Timeliness',
			//'type' => 'raw',
			//'value' => "$form->radioButtonListRow($model,'pv',array('PVU'))", // add this code
            //'separator'=>'',
    	//),
    	 array(
             'name' => 'pv',
            'type'=>'raw',
            'header' => CHtml::checkBox("checkedRow_all","",array("id"=>"checkedRow_all")),
            'value' => 'CHtml::checkBox("checkRow[$data[personeelsnummer]]","")',
            //'class' => 'CCheckBoxColumn',
            //'selectableRows' => '2',
            //'header'=>'Selected',
            //'id'=>'checkedRow',
            //'htmlOptions'=>array("width"=>"50px"),
            //'id'=>'someChecks', // need this id for use with $.fn.yiiGridView.getChecked(containerID,columnID)
            //'checked'=>'$data[personeelsnummer]', // we are using the user session variable to store the checked row values, also considering here that email_ids are unique for your app, it would be best to use any field that is unique in the table
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