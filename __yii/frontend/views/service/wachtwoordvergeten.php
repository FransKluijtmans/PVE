<?php
$this->pageTitle=Yii::app()->name . ' - Wachtwoord vergeten';
$this->breadcrumbs=array(
	'Service'=>array('service/index'),
	'Wachtwoord vergeten',
);
?>

<h1>Wachtwoord vergeten</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Met onderstaand formulier kun je een nieuw wachtwoord aanvragen. U krijgt deze dan per email (zoals bij ons bekend) toegestuurd.
</p>

<ul class="form-fields">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<li>
		<?php echo $form->labelEx($model,'personeelsnummer'); ?>
		<?php echo $form->textField($model,'personeelsnummer'); ?>
		<?php echo $form->error($model,'personeelsnummer'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</li>

	<li>
		<?php echo CHtml::submitButton('Aanvragen', array('class' => 'btn')); ?>
	</li>

<?php $this->endWidget(); ?>

</ul><!-- form -->

<?php endif; ?>