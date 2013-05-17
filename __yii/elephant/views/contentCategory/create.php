<?php
$this->breadcrumbs=array(
	'Content Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Categorieen overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Nieuwe categorie</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>