<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'leden-cspa-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->fileField($model, 'files'); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Maken',
		'icon'=>'arrow-right white',
		'loadingText'=>'verwerken...',
	));
	$this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'link',
		'type'=>'link',
		'label'=>'Annuleren',
		'url'=>Yii::app()->request->urlReferrer,
	));

$this->endWidget(); ?>
