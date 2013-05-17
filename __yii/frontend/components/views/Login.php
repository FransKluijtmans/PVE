<div class='loginForm' id='loginForm'>
	<h2>Log in</h2>

	<ul class="form-fields">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>array('site/login'),
		'id'=>'login-form',
		//'enableClientValidation'=>true,
		'enableAjaxValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'afterValidate'=>'js:function(form,data,hasError){
	                        if(!hasError){
	                                $.ajax({
	                                        "type":"POST",
	                                        "url":"'.CHtml::normalizeUrl(array("site/login")).'",
	                                        "data":form.serialize(),
	                                        "success":function(data){$("#loginForm").html(data);},
	                                        });
	                                }
	                        }'
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
	<div class='extraInfoLogin'>
		<h3>Wachtwoord vergeten?</h3>
			<p><a href=<?php echo Yii::app()->request->baseUrl.'/index.php?r=service/wachtwoordvergeten' ?>>Klik hier</a> om een nieuw wachtwoord aan te vragen.</p>
	</div>
</div>