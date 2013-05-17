<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('naam')); ?>:</b>
	<?php echo CHtml::encode($data->naam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangemaakt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangepast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->userAangemaakt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->userAangepast); ?>
	<br />

</div>