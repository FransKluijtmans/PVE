<?php /** @var BootActiveForm $form */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'type'=>'horizontal',
    //'htmlOptions'=>array('class'=>'well'),
	//'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'personeelsnummer', array('size'=>15,'maxlength'=>15)); ?>
<?php echo $form->dropDownListRow($model, 'aanhef', array('M' => 'Dhr.', 'F' => 'Mevr.')); ?>
<?php echo $form->textFieldRow($model, 'voorletters', array('size'=>5,'maxlength'=>15)); ?>
<?php echo $form->textFieldRow($model, 'achternaam', array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->textFieldRow($model, 'voorvoegsel', array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->textFieldRow($model, 'emailAdres', array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->textFieldRow($model, 'rekeningNummer', array('size'=>10,'maxlength'=>10)); ?>
<?php echo $form->textFieldRow($model, 'huisNummer', array('size'=>4,'maxlength'=>4)); ?>
<?php echo $form->textFieldRow($model, 'toevoeging', array('size'=>2,'maxlength'=>2)); ?>
<?php echo $form->textFieldRow($model, 'postcode', array('size'=>6,'maxlength'=>6, 'class'=>'loadaddress-loadtext',
			'ajax' => array(
				'type'=>'POST', //request type
				//'dataType'=>'json',
				//'url'=>CController::createUrl('leden/UpdateAdres'),
				'url'=>CController::createUrl('leden/UpdateAdres'),
				//'data' => '{postcode : $("#Leden_postcode").val(), houseNumber : $("#Leden_huisNummer").val(), houseNumberAddition : $("#Leden_toevoeging").val() }',
				'success'=>'function(data){
					$("#Leden_straat").attr("readonly", true);
					$("#Leden_plaats").attr("readonly", true);
					if(data.status == "nok"){
						$(".help-block").hide();
					}else{
						$(".help-block").hide();
						$("#Leden_straat").val(data.street);
						$("#Leden_plaats").val(data.city);
					}
				}',
				'error'=>'function(data,status){
					$(".help-block").hide();
					$("#Leden_straat").attr("readonly", false);
					$("#Leden_plaats").attr("readonly", false);
				}',
				'beforeSend' => 'function(data){
					$(".help-block").show();
					if($("#Leden_huisNummer").val().length == 0 || $("#Leden_postcode").val().length < 6 )
			        {
			            data.abort();
			            return false
			        }
				}'
			),
			'hint'=>'<strong>Let op:</strong> De adresgegevens worden opgehaald. <span class="loading-icon"></span>',
			
		)
	); ?>
<?php echo $form->textFieldRow($model, 'straat', array('size'=>45,'maxlength'=>45, 'readonly'=>true)); ?>
<?php echo $form->textFieldRow($model, 'plaats', array('size'=>45,'maxlength'=>45, 'readonly'=>true)); ?>
<div class=control-group>
	<?php echo $form->labelEx($model, 'geboorteDatum', array('class'=>'control-label')); ?>
	<div class="controls">
		<?php echo $form->textField($model, 'geboorteDag', array('class'=>'formDatumKort', 'size'=>2, 'maxlength'=>2));//betere datum veld. ?>
		<?php echo $form->textField($model, 'geboorteMaand', array('class'=>'formDatumKort', 'size'=>2, 'maxlength'=>2));//betere datum veld. ?>
		<?php echo $form->textField($model, 'geboorteJaar', array('class'=>'formDatumJaar', 'size'=>4, 'maxlength'=>4));//betere datum veld. ?>
	</div>
</div>
<?php echo $form->textFieldRow($model, 'telefoonNummer'); ?>
<?php echo $form->textFieldRow($model, 'afdeling', array('size'=>45,'maxlength'=>45)); ?>
<?php echo $form->checkBoxRow($model, 'werkendLid'); ?>
<?php echo $form->checkBoxListRow($model, 'groepens', CHtml::listData(
				Groepen::model()->findAll(), 'id', 'naam'), array('multiple'=>'multiple', 'size'=>5)
); ?>
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
	'buttonType'=>'link',
	'type'=>'link',
	'label'=>'Annuleren',
	'url'=>Yii::app()->request->urlReferrer,
));

$this->endWidget();