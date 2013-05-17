<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,'titel'),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'titel',array('maxlength'=>75, 'class'=>'input-xxlarge')); ?>
	<?php echo $form->label($model,'content'); ?>
	<?php $this->widget('common.extensions.redactorjs.Redactor', array( 
		'model' => $model, 
		'attribute' => 'content',
		//'toolbar' => 'mini', 
		'height' => '30%',
		//'lang' => 'nl' ,
		'editorOptions' => array(
			'autoresize' => true, 
			'fixedBox' => true,
			), 
		)); 
	?>

	<?php //echo $form->textFieldRow($model,'icoonId',array('')); ?>
	<?php echo $form->dropDownListRow($model, 'contentCategories', CHtml::listData(
																			ContentCategory::model()->findAll(), 'id', 'omschrijving'),
																			array('prompt' => 'Selecteer een categorie',
																			'label' =>  'Inline label')); ?>
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
