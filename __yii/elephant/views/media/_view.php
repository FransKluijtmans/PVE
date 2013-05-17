<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('naam')); ?>:</b>
	<?php echo CHtml::encode($data->naam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('locatie')); ?>:</b>
	<?php echo CHtml::encode($data->locatie); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt')); ?>:</b>
	<?php echo CHtml::encode($data->alt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
	<?php echo CHtml::encode($data->height); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('width')); ?>:</b>
	<?php echo CHtml::encode($data->width); ?>
	<br />
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangemaakt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tbl_media_types_mediaTypesId')); ?>:</b>
	<?php echo CHtml::encode($data->tbl_media_types_mediaTypesId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangepast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangepast')); ?>:</b>
	<?php echo CHtml::encode($data->userAangepast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->userAangemaakt); ?>
	<br />

	*/ ?>

</div>