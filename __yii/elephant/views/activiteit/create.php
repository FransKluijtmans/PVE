<?php
$this->breadcrumbs=array(
	'Activiteits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Activiteiten overzicht', 'url'=>array('admin'), 'icon'=>'icon-list icon-white' ),
);
?>

<h1>Create Activiteit</h1>

<?php 
	if($step == '_formStep2'){
		echo $this->renderPartial($step, array('model'=>$model, 'prepopulate'=>$prepopulate, 'modelActiviteitData'=>$modelActiviteitData)); 
	}elseif($step == '_formStep3'){
		echo $this->renderPartial($step, array('model'=>$model, 'modelActiviteitOptions'=>$modelActiviteitOptions)); 
	}elseif($step == '_formContent'){
		echo $this->renderPartial($step, array('model'=>$model, 'modelActiviteitOptions'=>$modelActiviteitOptions, 'modelActiviteitData'=>$modelActiviteitData)); 
	}else{
		echo $this->renderPartial($step, array('model'=>$model)); 
	}
	?>