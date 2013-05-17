<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
	//'focus'=>array($model,'titel'),
	'stateful'=>true,
    'type'=>'horizontal'
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'titel',array('maxlength'=>45)); ?>
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
	<?php /*echo $form->dropDownListRow($model, 'contentCategories', CHtml::listData(
																			ContentCategory::model()->findAll(), 'id', 'omschrijving'),
																			array('prompt' => 'Selecteer een categorie',
																			'label' =>  'Inline label')); */?>
	<hr />
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Maken',
		'icon'=>'arrow-right white',
		'loadingText'=>'verwerken...',
		'htmlOptions'=>array('id'=>'buttonStateful'),
	));
	$this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'link',
        'label'=>'Terug naar stap 1',
        'htmlOptions'=>array('id'=>'buttonStateful', 'name'=>'step3'),
    ));
$this->endWidget();
print_r( $model->attributes);
echo '<br/>';
print_r(Yii::app()->session->get('step2'));
echo '<br/>0';
print_r($modelActiviteitData->attributes);
echo '<br/>1';
print_r( $modelActiviteitOptions->attributes);
echo '<br/>2';
//print_r( Yii::app()->session->get('step1'));
//print_r( Yii::app()->session->get('step2'));
//print_r( Yii::app()->session->get('step2'));