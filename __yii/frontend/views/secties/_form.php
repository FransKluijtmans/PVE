<?php
/* @var $this SectiesController */
/* @var $model Secties */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'secties-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'naam'); ?>
		<?php echo $form->textField($model,'naam',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'naam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'competitieModule'); ?>
		<?php echo $form->textField($model,'competitieModule'); ?>
		<?php echo $form->error($model,'competitieModule'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datumAangemaakt'); ?>
		<?php echo $form->textField($model,'datumAangemaakt'); ?>
		<?php echo $form->error($model,'datumAangemaakt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datumAangepast'); ?>
		<?php echo $form->textField($model,'datumAangepast'); ?>
		<?php echo $form->error($model,'datumAangepast'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userAangemaakt'); ?>
		<?php echo $form->textField($model,'userAangemaakt',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'userAangemaakt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userAangepast'); ?>
		<?php echo $form->textField($model,'userAangepast',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'userAangepast'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->