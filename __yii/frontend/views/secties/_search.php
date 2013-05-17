<?php
/* @var $this SectiesController */
/* @var $model Secties */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'naam'); ?>
		<?php echo $form->textField($model,'naam',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'info'); ?>
		<?php echo $form->textArea($model,'info',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'competitieModule'); ?>
		<?php echo $form->textField($model,'competitieModule'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datumAangemaakt'); ?>
		<?php echo $form->textField($model,'datumAangemaakt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datumAangepast'); ?>
		<?php echo $form->textField($model,'datumAangepast'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userAangemaakt'); ?>
		<?php echo $form->textField($model,'userAangemaakt',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userAangepast'); ?>
		<?php echo $form->textField($model,'userAangepast',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->