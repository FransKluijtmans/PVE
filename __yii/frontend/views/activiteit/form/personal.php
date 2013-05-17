<?php
/* @var $this ActiviteitController */
/* @var $model Activiteit */
/* @var $form CActiveForm */
?>

<ul class="form-fields--readonly">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'activiteit-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<p class="note">Controleer uw NAW gegevens voor het aanmelden voor deze activiteit. Als uw NAW gegevens niet kloppen, dat deze eerst aan via het <?php echo CHtml::link('adreswijzigen formulier', array("/service/updateleden")) ?>.</p>

	<li>
		<?php echo $form->label($model,'aanhef'); ?>
		<?php echo $form->textField($model,'aanhef', array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'voorletters'); ?>
		<?php echo $form->textField($model,'voorletters', array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'voorvoegsel'); ?>
		<?php echo $form->textField($model,'voorvoegsel', array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'achternaam'); ?>
		<?php echo $form->textField($model,'achternaam',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'emailAdres'); ?>
		<?php echo $form->textField($model,'emailAdres',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'rekeningNummer'); ?>
		<?php echo $form->textField($model,'rekeningNummer',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'straat'); ?>
		<?php echo $form->textField($model,'straat',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'huisNummer'); ?>
		<?php echo $form->textField($model,'huisNummer',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'toevoeging'); ?>
		<?php echo $form->textField($model,'toevoeging',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'plaats'); ?>
		<?php echo $form->textField($model,'plaats',array('readonly'=>true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'geboorteDatum'); ?>
		<?php echo $form->textField($model,'geboorteDatum'); ?>
	</li>

	<li>
		<?php echo $form->label($model,'telefoonNummer'); ?>
		<?php echo $form->textField($model,'telefoonNummer'); ?>
	</li>

	<li>
		<?php echo CHtml::submitButton('Volgende stap  &rarr;', array('class' => 'btn--formNextStep')); ?>
	</li>

<?php $this->endWidget(); ?>

</ul><!-- form -->