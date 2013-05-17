<?php
$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Personeelsvereniging'=>array('index'),
	'Contact',
);
?>

<h1>Contactgegevens</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Het bestuur van de Personeelsvereniging Rabobank Nederland, afdeling Eindhoven en Best.
Heeft u vragen voor het bestuur? Stuur dan een mailtje naar dit emailadres.
</p>

<div class="form">


</div><!-- form -->

<?php endif; ?>