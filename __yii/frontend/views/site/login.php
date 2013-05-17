<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Inloggen</h1>

<p>Je kunt hier inloggen om:</p> 
<ul>
	<li>je op te geven voor activiteiten,</li>
	<li>je adres gegevens te wijzigen,</li>
	<li>te bekijken voor welke activiteiten je aangemeld hebt.</li>
</ul>

<ul class="form-fields">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	//'enableClientValidation'=>true,
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<li>
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('autocomplete'=>"off")); ?>
		<?php echo $form->error($model,'username'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</li>

	<li class="rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</li>
	<li>
		<?php echo CHtml::submitButton('Inloggen', array('class' => 'btn')); ?>
	</li>
	<?php $this->endWidget(); ?>
</ul><!-- form -->
