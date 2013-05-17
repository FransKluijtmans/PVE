<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'content-category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'omschrijving',array('maxlength'=>45)); ?>
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
