<div class='loginForm' id='loginForm'>
	<h2><?php echo Yii::app()->session['volledigenaam']; ?></h2>
	<ul class="loggedinlist">
		<li><?php echo CHtml::link('Service',array('service/index')); ?></li>
		<li><?php echo CHtml::link('Aangemelde activiteiten',array('service/aangemeldeactiviteiten')); ?></li>
		<li class="divider"></li>
		<li><a href="<?php echo $this->createUrl('site/logout') ?>">Uitloggen [<?php echo Yii::app()->user->name ?>]</a></li>
	</ul>
</div>
