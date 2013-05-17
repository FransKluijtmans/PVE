<?php
$this->pageTitle=Yii::app()->name . ' - Wachtwoord vergeten';
$this->breadcrumbs=array(
	'Service'=>array('service/index'),
	'Activiteiten',
);
?>

<h1>Activiteiten</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Hier staan alle activiteiten waar u zich voor heeft aangemeld.
</p>
<?php $this->widget('frontend.components.ActGridView', array(
	'id'=>'activiteit-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model, -> hide search
	'itemsCssClass'=>'tableOverview',
	'template' => '{items}',
	'enableSorting'=>false,
	'showTableOnEmpty'=>false,
	'emptyText'=>'Er zijn geen gegevens beschikbaar.',
	'hideHeader'=>true,
	//'rowCssClassExpression'=>'($row % 2 == 1) ? "css_class_for_hidden_row" : "css_class_for_normal_row"',
	'columns'=>array(
		'leden_personeelsnummer',
		'datumAanmelding',
		array(
			'class'=>'CLinkColumn',
			'label'=>'Details',
			'htmlOptions' => array(
                    'class' => 'detailsGrid'
                ),
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>'Aanpassen',
			'urlExpression'=>'Yii::app()->createUrl("activiteit/update",array("id"=>$data->id))',
			'linkHtmlOptions'=>array('title'=>'Aanpassen van deze acitiviteit')
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

<h3>Activiteiten waar je nog voor kunt aanmelden</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'activiteit-grid',
	'dataProvider'=>$dataProviderNot,
	//'filter'=>$model, -> hide search
	'itemsCssClass'=>'tableOverview',
	'template' => '{items}',
	'enableSorting'=>false,
	'showTableOnEmpty'=>false,
	'emptyText'=>'Er zijn geen gegevens beschikbaar.',
	'hideHeader'=>true,
	'columns'=>array(
		'id',
		'naam'
	),
)); ?>
<?php endif; ?>