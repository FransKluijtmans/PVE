<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'eindDatum',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'aantalData',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'aantalOpties',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'eigenVervoer',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'extraUitleg',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'datumAangemaakt',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'secties_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'geschikt',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'naam',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'emailTekst',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'content_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'datumAangepast',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'userAangepast',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'userAangemaakt',array('class'=>'span5','maxlength'=>15)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'submit'
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
