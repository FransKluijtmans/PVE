<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('gebruiker')); ?>:</b>
	<?php echo CHtml::encode($data->gebruiker); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('leden_personeelsnummer')); ?>:</b>
	<?php echo CHtml::encode($data->leden_personeelsnummer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('functies_id')); ?>:</b>
	<?php echo CHtml::encode($data->functies->omschrijving); ?>
	<br />


</div>