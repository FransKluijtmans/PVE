<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'verticalForm',
	'focus'=>array($model,'leden_personeelsnummer'),
	//'enableAjaxValidation'=>true,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->dropDownListRow($model, 
										'leden_personeelsnummer', 
										$data = CHtml::listData(Leden::model()
																	->with('adminPersoneelsnummer')
																	->findAll(array('condition'=>'personeelsnummer NOT IN (SELECT leden_personeelsnummer 
																															FROM admin 
																															WHERE admin.leden_personeelsnummer = personeelsnummer)')
																), 
																'personeelsnummer', 
																'personeelsnummernaam'), 
																array('prompt' => 'Selecteer een personeelslid')); ?>
	<?php echo $form->textFieldRow($model, 'wachtwoord', array('readonly'=>true, 'class' => 'genereerWachtwoord')); ?>
    <?php
	$this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'ajaxLink',
		'url'=> $this->createUrl('admin/generatePassword'), 
        'type'=>'primary',
        'label'=>'Genereer wachtwoord',
        'icon'=>'arrow-right white',
        'loadingText'=>'verwerken...',
        'htmlOptions'=>array('id'=>'buttonStatefulAjax'),
		'ajaxOptions'=>array(	'success' => 'js:function(result) {
													$("#Admin_wachtwoord").val(result);
													$("#buttonStatefulAjax").removeAttr("disabled");
													$("#buttonStatefulAjax").removeClass("disabled");
													$("#buttonStatefulAjax").html("<i></i> Genereer wachtwoord");
													$("i").addClass("icon-arrow-right icon-white");
												}'
							),
    )); 
    ?>
	<?php echo $form->dropDownListRow($model, 'functies_id', $data = CHtml::listData(Functies::model()->findAll(), 
																									'id', 
																									'omschrijving'), 
																									array('prompt' => 'Selecteer een functierol')); ?>
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