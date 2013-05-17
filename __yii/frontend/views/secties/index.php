<?php
/* @var $this SectiesController */

$this->breadcrumbs=array(
	'Secties',
);
?>
<h1>Secties</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'activiteit-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model, -> hide search
	'itemsCssClass'=>'tableOverview',
	'template' => '{items}',
	'enableSorting'=>false,
	'showTableOnEmpty'=>false,
	'emptyText'=>'Er zijn geen gegevens beschikbaar.',
	'hideHeader'=>true,
	'columns'=>array(
		array(
			'name'=>'naam',
			'type'=>'raw',
			'value'=>'CHtml::link($data->naam, array("/secties/view", "id"=>$data->id))',
		),
		/*'aantalData',
		'aantalOpties',
		'eigenVervoer',
		'extraUitleg',
		'datumAangemaakt',
		'secties_id',
		'geschikt',
		'emailTekst',
		'content_id',
		'datumAangepast',
		'userAangepast',
		'userAangemaakt',
		*/
	),
)); ?>
