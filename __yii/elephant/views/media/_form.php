<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'media-form',
	'enableAjaxValidation'=>true, 
	'stateful'=>true, 
	'focus'=>array($model,'naam'),
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'naam',array('maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'title',array('maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'alt',array('maxlength'=>45)); ?>
	<div class='uploadFile'>
	<?php echo $form->fileField($model, 'files'); ?>
	</div>
	<hr />
	<?php 
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Maken',
		'icon'=>'arrow-right white',
		'loadingText'=>'verwerken...',
	));
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'link',
		'type'=>'link',
		'label'=>'Annuleren',
		'url'=>Yii::app()->request->urlReferrer,
	));

$this->endWidget();