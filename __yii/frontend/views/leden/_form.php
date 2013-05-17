<?php
/* @var $this LedenController */
/* @var $model Leden */
/* @var $form CActiveForm */
?>

<ul class="form-fields">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'leden-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<p class="note">Hier kunt u uw naw gegevens wijzigen. Deze wijziging zal meteen worden verwerkt.</p>

	<?php echo $form->errorSummary($model); ?>

	<li>
		<?php echo $form->labelEx($model,'aanhef'); ?>
		<?php echo $form->textField($model,'aanhef',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'aanhef'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'voorletters'); ?>
		<?php echo $form->textField($model,'voorletters',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'voorletters'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'achternaam'); ?>
		<?php echo $form->textField($model,'achternaam',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'achternaam'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'voorvoegsel'); ?>
		<?php echo $form->textField($model,'voorvoegsel',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'voorvoegsel'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'emailAdres'); ?>
		<?php echo $form->textField($model,'emailAdres',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'emailAdres'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'rekeningNummer'); ?>
		<?php echo $form->textField($model,'rekeningNummer',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rekeningNummer'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'straat'); ?>
		<?php echo $form->textField($model,'straat',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'straat'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'huisNummer'); ?>
		<?php echo $form->textField($model,'huisNummer',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'huisNummer'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'toevoeging'); ?>
		<?php echo $form->textField($model,'toevoeging',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'toevoeging'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'plaats'); ?>
		<?php echo $form->textField($model,'plaats',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'plaats'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'geboorteDatum'); ?>
		<?php echo $form->textField($model,'geboorteDatum'); ?>
		<?php echo $form->error($model,'geboorteDatum'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'telefoonNummer'); ?>
		<?php echo $form->textField($model,'telefoonNummer'); ?>
		<?php echo $form->error($model,'telefoonNummer'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'statusAanmelding'); ?>
		<?php echo $form->textField($model,'statusAanmelding'); ?>
		<?php echo $form->error($model,'statusAanmelding'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'afdeling'); ?>
		<?php echo $form->textField($model,'afdeling',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'afdeling'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'werkendLid'); ?>
		<?php echo $form->textField($model,'werkendLid'); ?>
		<?php echo $form->error($model,'werkendLid'); ?>
	</li>

	<li>
		<?php echo CHtml::submitButton('Aanpassen', array('class' => 'btn')); ?>
	</li>

<?php $this->endWidget(); ?>

</ul><!-- form -->