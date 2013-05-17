<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'personeelsnummer',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'aanhef',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'voorletters',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'achternaam',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'voorvoegsel',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'tweede_achternaam',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'tweede_voorvoegsel',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'adres',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'postcode',array('class'=>'span5','maxlength'=>7)); ?>

	<?php echo $form->textFieldRow($model,'plaats',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'geboortedatum',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'bijdrage',array('class'=>'span5','maxlength'=>6)); ?>

	<?php echo $form->textFieldRow($model,'pv',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit'
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
