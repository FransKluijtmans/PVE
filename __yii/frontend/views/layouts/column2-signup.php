<?php $this->beginContent('//layouts/main'); ?>
<div>
        
	<div class='grid  two-thirds  content'>
		<?php echo $content; ?>
	</div><!-- /content -->
		        
	<div class='grid  one-third  sub-content'>
		
		<?php 
			//add widget for form steps
			$this->widget('WidgetFormSteps'); 
			$this->widget('Peevee', array(
				'maxComments'=>10,
			)); 
		?>
	</div><!-- /sub-content -->

</div><!-- /wrapper -->
<?php $this->endContent(); ?>