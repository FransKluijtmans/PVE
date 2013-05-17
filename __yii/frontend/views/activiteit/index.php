<?php
/* @var $this ActiviteitController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Activiteiten',
);

$this->menu=array(
	array('label'=>'Create Activiteit', 'url'=>array('create')),
	array('label'=>'Manage Activiteit', 'url'=>array('admin')),
);
?>

<h1>Activiteiten</h1>
<p>Hieronder staan alle nog komende en alle activiteiten die al hebben plaatsgevonden weergegeven. De getoonde datum is de uiterste datum van inschrijving.</p>

<h2>Komende activiteiten.</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'activiteit-grid',
	'dataProvider'=>$modelDateFuture,
	//'filter'=>$model, -> hide search
	'itemsCssClass'=>'tableOverview',
	'template' => '{items}',
	'enableSorting'=>false,
	'showTableOnEmpty'=>false,
	'emptyText'=>'Er zijn geen gegevens beschikbaar.',
	'hideHeader'=>true,
	'columns'=>array(
		array(      
            'name'=>'datum',
            'value'=>'Yii::app()->dateFormatter->formatDateTime($data->datum,"long",NULL)',
        ),
		array(
			'name'=>'naam',
			'type'=>'raw',
			'value'=>'CHtml::link($data->activiteit->naam, array("/activiteit/signup", "id"=>$data->activiteit->id))',
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

<h2>Activiteiten die zijn geweest.</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'activiteit-grid',
	'dataProvider'=>$modelDatePast,
	//'filter'=>$model, -> hide search
	'itemsCssClass'=>'tableOverview',
	'template' => '{items}',
	'enableSorting'=>false,
	'showTableOnEmpty'=>false,
	'emptyText'=>'Er zijn geen gegevens beschikbaar.',
	'hideHeader'=>true,
	'columns'=>array(
		array(      
            'name'=>'datum',
            'value'=>'Yii::app()->dateFormatter->formatDateTime($data->datum,"long",NULL)',
        ),
		array(
			'name'=>'naam',
			'type'=>'raw',
			'value'=>'CHtml::link($data->activiteit->naam, array("/activiteit/view", "id"=>$data->activiteit->id))',
		),
	),
));
