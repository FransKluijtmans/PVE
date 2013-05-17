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
		<?php echo $form->label($model,'gebruiker'); ?>
		<?php echo $form->textField($model,'gebruiker',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wachtwoord'); ?>
		<?php echo $form->textField($model,'wachtwoord',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datumGewijzigd'); ?>
		<?php echo $form->textField($model,'datumGewijzigd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'initieelGewijzigd'); ?>
		<?php echo $form->textField($model,'initieelGewijzigd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'leden_personeelsnummer'); ?>
		<?php echo $form->textField($model,'leden_personeelsnummer',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'functies_id'); ?>
		<?php echo $form->textField($model,'functies_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->