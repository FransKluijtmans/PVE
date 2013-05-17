<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('personeelsnummer')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->personeelsnummer),array('view','id'=>$data->personeelsnummer)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aanhef')); ?>:</b>
	<?php echo CHtml::encode($data->aanhef); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voorletters')); ?>:</b>
	<?php echo CHtml::encode($data->voorletters); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('achternaam')); ?>:</b>
	<?php echo CHtml::encode($data->achternaam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voorvoegsel')); ?>:</b>
	<?php echo CHtml::encode($data->voorvoegsel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tweede_achternaam')); ?>:</b>
	<?php echo CHtml::encode($data->tweede_achternaam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tweede_voorvoegsel')); ?>:</b>
	<?php echo CHtml::encode($data->tweede_voorvoegsel); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('adres')); ?>:</b>
	<?php echo CHtml::encode($data->adres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postcode')); ?>:</b>
	<?php echo CHtml::encode($data->postcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plaats')); ?>:</b>
	<?php echo CHtml::encode($data->plaats); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geboortedatum')); ?>:</b>
	<?php echo CHtml::encode($data->geboortedatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bijdrage')); ?>:</b>
	<?php echo CHtml::encode($data->bijdrage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pv')); ?>:</b>
	<?php echo CHtml::encode($data->pv); ?>
	<br />

	*/ ?>

</div>