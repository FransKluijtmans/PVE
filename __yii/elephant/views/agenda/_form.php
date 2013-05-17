<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'agenda-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'omschrijving',array('class'=>'input-xxlarge','maxlength'=>45)); ?>

	<?php echo $form->datepickerRow($model, 'datum', array('prepend'=>'<i class="icon-calendar"></i>', 'options'=>array('format' => 'dd-mm-yyyy', 'value'=>date('dd/mm/yy'),))); ?>

	<?php //echo $form->textFieldRow($model,'datumAangemaakt',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'datumAangepast',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model, 'secties_id', $data = CHtml::listData(Secties::model()->findAll(), 
																									'id', 
																									'naam'), 
																									array('prompt' => 'Selecteer een sectie','class'=>'input-xlarge'));?>

	<?php echo $form->dropDownListRow($model, 'contents', $data = CHtml::listData(Content::model()->findAll(), 
																									'id', 
																									'titel'), 
																									array('prompt' => 'Selecteer een artikel','class'=>'input-xlarge'));?>

	<?php //echo $form->textFieldRow($model,'userAangemaakt',array('class'=>'span5','maxlength'=>15)); ?>

	<?php //echo $form->textFieldRow($model,'userAangepast',array('class'=>'span5','maxlength'=>15)); ?>

	<hr />
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		//'label'=>'Maken',
		'label'=>$model->isNewRecord ? 'Maken' : 'Opslaan',
		'icon'=>'arrow-right white',
		'loadingText'=>'verwerken...',
		'htmlOptions'=>array('id'=>'buttonStateful'),
	));
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'link',
		'type'=>'link',
		'label'=>'Annuleren',
		'url'=>Yii::app()->request->urlReferrer,
	));
$this->endWidget();
