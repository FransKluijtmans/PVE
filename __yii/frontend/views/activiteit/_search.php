<?php
/* @var $this ActiviteitController */
/* @var $model Activiteit */
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
		<?php echo $form->label($model,'eindDatum'); ?>
		<?php echo $form->textField($model,'eindDatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aantalData'); ?>
		<?php echo $form->textField($model,'aantalData'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aantalOpties'); ?>
		<?php echo $form->textField($model,'aantalOpties'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eigenVervoer'); ?>
		<?php echo $form->textField($model,'eigenVervoer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'extraUitleg'); ?>
		<?php echo $form->textField($model,'extraUitleg',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datumAangemaakt'); ?>
		<?php echo $form->textField($model,'datumAangemaakt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secties_id'); ?>
		<?php echo $form->textField($model,'secties_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'geschikt'); ?>
		<?php echo $form->textField($model,'geschikt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'naam'); ?>
		<?php echo $form->textField($model,'naam',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emailTekst'); ?>
		<?php echo $form->textField($model,'emailTekst',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content_id'); ?>
		<?php echo $form->textField($model,'content_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datumAangepast'); ?>
		<?php echo $form->textField($model,'datumAangepast'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userAangepast'); ?>
		<?php echo $form->textField($model,'userAangepast',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userAangemaakt'); ?>
		<?php echo $form->textField($model,'userAangemaakt',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->