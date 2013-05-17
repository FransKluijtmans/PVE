<?php
/* @var $this ActiviteitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Service',
);
?>

<h1>Service</h1>
<ul>
	<?php if(Yii::app()->user->isGuest): ?>
	<li><?php echo CHtml::link('Wachtwoord vergeten',array('service/wachtwoordvergeten')); ?></li>
	<?php endif; ?>
	<?php if(!Yii::app()->user->isGuest): ?>
	<li><?php echo CHtml::link('Aangemelde activiteiten',array('service/aangemeldeactiviteiten')); ?></li>
	<li><?php echo CHtml::link('Adres wijzigen',array('service/updateleden')); ?></li>
	<?php endif; ?>
</ul>
<?php if(Yii::app()->user->isGuest): ?>
	<p>Wil je kijken voor welke activiteiten je hebt aangemeld of je adres wijzigen, <?php echo CHtml::link('log dan eerst in',array('site/login')); ?>.</p>
<?php endif; ?>