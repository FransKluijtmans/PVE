<?php
$this->menu=array(
	array('label'=>'List LedenCspa','url'=>array('index')),
	array('label'=>'Create LedenCspa','url'=>array('create')),
);
?>

<h1>CSPA</h1>
<?php echo $this->renderPartial('_viewStats', array('model'=>$model)); ?>
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
    )); ?>
<?php echo $this->renderPartial('_formUpload', array('model'=>$model)); ?>

<?php /*$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'leden-cspa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'personeelsnummer',
		'aanhef',
		'voorletters',
		'achternaam',
		'voorvoegsel',
		'tweede_achternaam',
		'tweede_voorvoegsel',
		'adres',
		'postcode',
		'plaats',
		'geboortedatum',
		'bijdrage',
		'pv',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));*/ ?>
