<?php
/* @var $this ActiviteitController */
/* @var $model Activiteit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'activiteit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'eindDatum'); ?>
		<?php echo $form->textField($model,'eindDatum'); ?>
		<?php echo $form->error($model,'eindDatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aantalData'); ?>
		<?php echo $form->textField($model,'aantalData'); ?>
		<?php echo $form->error($model,'aantalData'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aantalOpties'); ?>
		<?php echo $form->textField($model,'aantalOpties'); ?>
		<?php echo $form->error($model,'aantalOpties'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eigenVervoer'); ?>
		<?php echo $form->textField($model,'eigenVervoer'); ?>
		<?php echo $form->error($model,'eigenVervoer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'extraUitleg'); ?>
		<?php echo $form->textField($model,'extraUitleg',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'extraUitleg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datumAangemaakt'); ?>
		<?php echo $form->textField($model,'datumAangemaakt'); ?>
		<?php echo $form->error($model,'datumAangemaakt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secties_id'); ?>
		<?php echo $form->textField($model,'secties_id'); ?>
		<?php echo $form->error($model,'secties_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'geschikt'); ?>
		<?php echo $form->textField($model,'geschikt'); ?>
		<?php echo $form->error($model,'geschikt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'naam'); ?>
		<?php echo $form->textField($model,'naam',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'naam'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emailTekst'); ?>
		<?php echo $form->textField($model,'emailTekst',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'emailTekst'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content_id'); ?>
		<?php echo $form->textField($model,'content_id'); ?>
		<?php echo $form->error($model,'content_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datumAangepast'); ?>
		<?php echo $form->textField($model,'datumAangepast'); ?>
		<?php echo $form->error($model,'datumAangepast'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userAangepast'); ?>
		<?php echo $form->textField($model,'userAangepast',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'userAangepast'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userAangemaakt'); ?>
		<?php echo $form->textField($model,'userAangemaakt',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'userAangemaakt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->