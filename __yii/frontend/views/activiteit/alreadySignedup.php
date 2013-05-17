<?php
/* @var $this ActiviteitController */
/* @var $model Activiteit */

$this->breadcrumbs=array(
	'Activiteiten'=>array('index'),
	'Al aangemeld voor '.ucfirst($model->naam),
);

$this->menu=array(
	array('label'=>'List Activiteit', 'url'=>array('index')),
	array('label'=>'Manage Activiteit', 'url'=>array('admin')),
);
?>

<h1>Al aangemeld voor <?php echo $model->naam ?></h1>
<p>U heeft zich al eerder aangemeld voor de activiteit '<?php echo ucfirst($model->naam); ?>'. U kunt <?php echo CHtml::link('uw aanmeldingen',array('service/aangemeldeactiviteiten')); ?> ook bekijken.</p>