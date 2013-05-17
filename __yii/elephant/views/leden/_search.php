<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'personeelsnummer'); ?>
		<?php echo $form->textField($model,'personeelsnummer',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aanhef'); ?>
		<?php echo $form->textField($model,'aanhef',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voorletters'); ?>
		<?php echo $form->textField($model,'voorletters',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'achternaam'); ?>
		<?php echo $form->textField($model,'achternaam',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voorvoegsel'); ?>
		<?php echo $form->textField($model,'voorvoegsel',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'emailAdres'); ?>
		<?php echo $form->textField($model,'emailAdres',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rekeningNummer'); ?>
		<?php echo $form->textField($model,'rekeningNummer',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'straat'); ?>
		<?php echo $form->textField($model,'straat',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'huisNummer'); ?>
		<?php echo $form->textField($model,'huisNummer',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'toevoeging'); ?>
		<?php echo $form->textField($model,'toevoeging',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plaats'); ?>
		<?php echo $form->textField($model,'plaats',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'geboorteDatum'); ?>
		<?php echo $form->textField($model,'geboorteDatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefoonNummer'); ?>
		<?php echo $form->textField($model,'telefoonNummer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datumGewijzigd'); ?>
		<?php echo $form->textField($model,'datumGewijzigd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statusAanmelding'); ?>
		<?php echo $form->textField($model,'statusAanmelding'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afdeling'); ?>
		<?php echo $form->textField($model,'afdeling',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'redenLid'); ?>
		<?php echo $form->textField($model,'redenLid',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'werkendLid'); ?>
		<?php echo $form->textField($model,'werkendLid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ledenFunctie'); ?>
		<?php echo $form->textField($model,'ledenFunctie',array('size'=>11,'maxlength'=>11)); ?>
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