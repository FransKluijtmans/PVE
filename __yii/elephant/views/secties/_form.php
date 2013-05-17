<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    //'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'naam', array()); ?>
<?php echo $form->textFieldRow($model, 'email', array()); ?>
<?php $this->widget('common.extensions.redactorjs.Redactor', array( 
	'model' => $model, 
	'attribute' => 'info', 
	'toolbar' => 'mini', 
	'height' => '30%',
	//'lang' => 'nl' ,
	'editorOptions' => array(
		'autoresize' => true, 
		'fixedBox' => true,
		), 
	)); 
?>
<?php echo $form->error($model,'info'); ?>
<?php echo $form->checkboxRow($model, 'competitieModule'); ?>
<hr />
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
));
$this->endWidget();