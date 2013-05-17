<?php
/* @var $this SectiesController */
/* @var $data Secties */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('naam')); ?>:</b>
	<?php echo CHtml::encode($data->naam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
	<?php echo CHtml::encode($data->info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('competitieModule')); ?>:</b>
	<?php echo CHtml::encode($data->competitieModule); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangemaakt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangepast); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->userAangemaakt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->userAangepast); ?>
	<br />

	*/ ?>

</div>