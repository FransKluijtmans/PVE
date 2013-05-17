<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    //'htmlOptions'=>array('class'=>'well'),
	//'enableAjaxValidation'=>true,
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'naam', array()); ?>
<hr />
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit',
	'type'=>'primary',
	'label'=>'Maken',
	'icon'=>'arrow-right white',
	'loadingText'=>'verwerken...',
	'htmlOptions'=>array('id'=>'buttonStateful'),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'link',
	'type'=>'link',
	'label'=>'Annuleren',
	'url'=>Yii::app()->request->urlReferrer,
)); ?>

<?php $this->endWidget(); ?>