<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'activiteit-form',
	'enableAjaxValidation'=>false,
	'stateful'=>true,
)); ?>
	<h3>Basis activiteit gegevens - Stap 1</h3>
<?php $this->widget('bootstrap.widgets.TbProgress', array(
    'type'=>'info', // 'info', 'success' or 'danger'
    'percent'=>0, // the progress
    'striped'=>false,
    'animated'=>false,
)); ?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldRow($model,'naam',array('maxlength'=>45)); ?>
	<?php echo $form->dropDownListRow($model, 'secties_id', $data = CHtml::listData(Secties::model()->findAll(), 
																									'id', 
																									'naam'), 
																									array('prompt' => 'Selecteer een sectie'));?>
	<?php //echo $form->textFieldRow($model,'eindDatum',array('class'=>'span5')); ?>
	 <?php echo $form->datepickerRow($model, 'eindDatum', array('prepend'=>'<i class="icon-calendar"></i>', 'options'=>array('format' => 'dd-mm-yyyy'))); ?>
	<?php //echo $form->timepickerRow($model, 'extraUitleg', array('hint'=>'Nice bootstrap time picker', 'append'=>'<i class="icon-time" style="cursor:pointer"></i>'));?>

	<?php echo $form->dropDownListRow($model, 'aantalData', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5')); ?>

	<?php echo $form->dropDownListRow($model, 'aantalOpties', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10')); ?>

	<?php echo $form->checkBoxRow($model,'eigenVervoer'); ?>

	<?php echo $form->textAreaRow($model, 'extraUitleg', array('class'=>'span4', 'rows'=>5)); ?>
	<?php //echo $form->textFieldRow($model,'extraUitleg',array('class'=>'span5','maxlength'=>255)); ?>
	
	<?php echo $form->textAreaRow($model, 'emailTekst', array('class'=>'span4', 'rows'=>5)); ?>

	<?php //echo $form->textFieldRow($model,'content_id'); ?>
	<?php echo $form->checkBoxListRow($model, 'groepen', CHtml::listData(
				Groepen::model()->findAll(), 'id', 'naam'), array('multiple'=>'multiple', 'size'=>5)
				); ?>
	<hr />
	<?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Naar stap 2',
        'icon'=>'arrow-right white',
        'loadingText'=>'verwerken...',
        'htmlOptions'=>array('id'=>'buttonStateful', 'name'=>'step2'),
    )); ?>
	<?php /* $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>'link',
        'label'=>'Annuleren',
        'url'=>Yii::app()->request->urlReferrer,
    )); */ ?>

<?php $this->endWidget(); ?>