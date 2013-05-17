<?php
/* @var $this SectiesController */
/* @var $model Secties */

$this->breadcrumbs=array(
	'Secties'=>array('index'),
	$model->naam,
);

$this->menu=array(
	array('label'=>'List Secties', 'url'=>array('index')),
	array('label'=>'Create Secties', 'url'=>array('create')),
	array('label'=>'Update Secties', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Secties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Secties', 'url'=>array('admin')),
);
?>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDEybgKYCKqzswbepcaF_5ah76LXCG1SM0&sensor=false">
</script>

<script>
function initialize()
{
var mapProp = {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById("googleMap")
  ,mapProp);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div class='grid  one-whole  content'>
<h1><?php echo $model->naam; ?> sectie - Sporthallen</h1>

<div id="googleMap" style="height:400px;"></div>
</div>
<div class='grid  two-thirds  content'>
<p><?php echo $model->info; ?></p>
</div>
