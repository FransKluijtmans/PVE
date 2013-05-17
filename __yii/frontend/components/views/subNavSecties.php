<ul >
	<?php foreach($this->getSubNav() as $subnav): ?>
	<li><?php //echo $articles->titel; ?>
		<a href="<?php echo Yii::app()->createUrl('secties/'.$subnav->route, array('id' => $this->sectieid)); ?>"><?php echo $subnav->naam; ?></a>
	</li>
	<?php endforeach; ?>
</ul>