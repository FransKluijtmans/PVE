<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eindDatum')); ?>:</b>
	<?php echo CHtml::encode($data->eindDatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aantalData')); ?>:</b>
	<?php echo CHtml::encode($data->aantalData); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aantalOpties')); ?>:</b>
	<?php echo CHtml::encode($data->aantalOpties); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eigenVervoer')); ?>:</b>
	<?php echo CHtml::encode($data->eigenVervoer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extraUitleg')); ?>:</b>
	<?php echo CHtml::encode($data->extraUitleg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datumAangemaakt')); ?>:</b>
	<?php echo CHtml::encode($data->datumAangemaakt); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('secties_id')); ?>:</b>
	<?php echo CHtml::encode($data->secties_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geschikt')); ?>:</b>
	<?php echo CHtml::encode($data->geschikt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('naam')); ?>:</b>
	<?php echo CHtml::encode($data->naam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emailTekst')); ?>:</b>
	<?php echo CHtml::encode($data->emailTekst); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_id')); ?>:</b>
	<?php echo CHtml::encode($data->content_id); ?>
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