<?php $this->beginContent('//layouts/main'); ?>

	<?php if(!$this->layout_etalage): ?>
	<div class='grid  two-thirds  content'>
		<?php echo $content; ?>
	</div><!-- /content -->
	<?php else: ?>
		<?php echo $content; ?>
	<?php endif; ?>

	<div class='grid  one-third  sub-content'>
		<?php 
			$this->widget('SubnavSecties', array(
				'sectieid'=>$this->sectie_id,
			)); 
		?>
	</div><!-- /sub-content -->


<?php $this->endContent(); ?>