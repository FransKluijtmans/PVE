<ul class='peevee'>
	<li>
		<h2>Peeveetjes</h2>
	</li>
	<?php foreach($this->getRecentArticles() as $articles): ?>
	<li><?php //echo $articles->titel; ?>
		<?php echo $articles->content; ?>
	</li>
	<?php endforeach; ?>
</ul>