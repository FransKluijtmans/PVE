<?php
$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Artikelen overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Nieuw artikel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>