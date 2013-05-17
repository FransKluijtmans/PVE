<?php
/* @var $this ActiviteitController */
/* @var $data Activiteit */
?>

<li class="view">

	<h2><?php echo ucfirst($data->titel); ?></h2>
	<?php echo $data->content; ?>
	<div class='tagarea'>
		<div class='tag'>
			<img src='img/iconmonstr-tag-6-icon.png' width=30  />
			<?php
				foreach($data->contentCategories as $cat) 
					echo trim($cat->omschrijving);
			?> 
		</div>
		<?php foreach($data->secties as $sectie) 
			if($sectie->id){ ?>
				<div class='tag'>
					<img src='img/iconmonstr-tag-6-icon.png' width=30  />
					<?php
						
							echo trim($sectie->naam);
					?>
				</div> 
			<?php } ?>
	</div>
	
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

</li>