<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'verticalForm',
			'focus'=>array($model,'huidige_wachtwoord'),
			//'htmlOptions'=>array('class'=>'well'),
			//'enableAjaxValidation'=>true,
			/*'clientOptions' => array(
				'validateOnSubmit'=>true,
				'validateOnChange'=>true,
				'validateOnType'=>false,
			),*/
		)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldRow($model, 'leden_personeelsnummer', array('value' => $model->leden_personeelsnummer, 'disabled'=>true)); ?>
	<?php echo $form->passwordFieldRow($model, 'huidige_wachtwoord', array('value' => '', 'maxlength'=>40)); ?>
	<?php echo $form->passwordFieldRow($model, 'wachtwoord', array('value' => '', 'maxlength'=>40, 'class'=>'genereerWachtwoord')); ?>
    <div class="pwstrength-visual-holder"><div class="strength-visual"><p class="strength-message"></p></div></div>
	<?php echo $form->passwordFieldRow($model,'repeat_wachtwoord',array('value' => '', 'maxlength'=>40)); ?>
	<?php 
		//als iemand geen admin is, dan mag je dit niet aanpassen
		if(Yii::app()->user->checkAccess('admin')){
			echo $form->dropDownListRow($model, 'functies_id', $data = CHtml::listData(Admin::model()->findAll(), 'functies_id', 'functies.omschrijving'), array('prompt' => 'Selecteer een functierol'));
		} ?>
	<hr />
	<?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Maken',
        'icon'=>'arrow-right white',
        'loadingText'=>'verwerken...',
        'htmlOptions'=>array('id'=>'buttonStateful'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>'link',
        'label'=>'Annuleren',
        'url'=>Yii::app()->request->urlReferrer,
    )); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->