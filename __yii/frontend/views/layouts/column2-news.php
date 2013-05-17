<?php $this->beginContent('//layouts/main'); ?>

        
	<div class='grid  two-thirds  news-content'>
		<?php echo $content; ?>
	</div><!-- /content -->
		        
	<div class='grid  one-third  sub-content'>
		<?php 
			if(Yii::app()->user->isGuest) {
				$this->widget('frontend.components.LoginWidget'); 
			}else{
				$this->renderPartial('/site/_loggedin');
			}

			$this->widget('Peevee', array(
				'maxComments'=>10,
			)); 
		?>
	</div><!-- /sub-content -->


<?php $this->endContent(); ?>