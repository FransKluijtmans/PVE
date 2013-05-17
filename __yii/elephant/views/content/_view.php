<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titel')); ?>:</b>
	<?php echo CHtml::encode($data->titel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangemaakt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangepast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->userAangepast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('icoonId')); ?>:</b>
	<?php echo CHtml::encode($data->icoonId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->userAangemaakt); ?>
	<br />

	*/ ?>

</div>