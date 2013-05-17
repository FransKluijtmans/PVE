<?php /* $auth=Yii::app()->authManager;

$bizRule='return !Yii::app()->user->isGuest;';
$auth->createRole('authenticated', 'authenticated user', $bizRule);
 
$bizRule='return Yii::app()->user->isGuest;';
$auth->createRole('guest', 'guest user', $bizRule);

$role = $auth->createRole('admin', 'administrator');
$auth->assign('admin',1); // adding admin to first user created
?>
$this->pageTitle=Yii::app()->name;*/ ?>
<?php $this->pageTitle=Yii::app()->name;?>
<h1>Welkom in <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php
/*$this->widget('bootstrap.widgets.TbGridView', array(
'dataProvider'=>$dataProviderTotaalLeden,
'columns'=>array(
'yearmonth',
'cc'
	)
)
);
$this->widget('common.extensions.highcharts.HighchartsWidget', array(
	'dataProvider'=>$dataProviderTotaalLeden,
	'template'=>'{items}',
	'options'=>array(
		'title' => array('text' => 'Totaal aantal leden', 'style' => array('font-family' => '"Open Sans","Helvetica Neue", Helvetica, Arial, sans-serif', 'font-weight' => 'normal')),
		'tooltip'=> array(
            'backgroundColor'=>'#AD76B2',
            'borderRadius'=>2,
            'borderWidth'=>0,
            'style' => array('padding' => '10px', 'color' => '#eee'),
            'headerFormat' => '<div style="font-size:1.2em; color: #fff; line-height: 22px ">{point.key}<br/></div>',
            'pointFormat' => '<div style="font-size:1.1em; color: #eee; ">{series.name}: <b>{point.y}</b></div>',
        ),
		'xAxis' => array(
			//'categories' => array('Apples', 'Bananas', 'Oranges'),
			'categories'=>'yearmonth',
			 'type'=>'datetime',
			 'minPadding' => 0,
            'maxPadding' => 0,
            'startOnTick' => true,
            'endOnTick' => true,
		),
		'yAxis' => array(
			'title' => '', //array('text' => 'Fruit eaten')
		),
		'series' => array(
			array(
				//array('name' => 'Jane', 'data' => array(1, 0, 4)),
				//'type'=>'areaspline',
				'type' => 'areaspline',
				'name'=>'Leden',             //title of data
				'dataResource'=>'cc',
			)
		),
		'chart'=> array(
            'height'=>350,
        ),
      'exporting' => array('enabled' => false),
      'theme' => 'elephant', 
      'legend' => false,
   )
));*/
$this->widget('common.extensions.highcharts.HighchartsWidget', array(
	'dataProvider'=>$dataProviderNweLeden,
	'template'=>'{items}',
	'id' => 'containerGraphs',
	'options'=>array(
		'title' => array('text' => 'Nieuwe leden', 'style' => array('font-family' => '"Open Sans","Helvetica Neue", Helvetica, Arial, sans-serif', 'font-weight' => 'normal')),
		'tooltip'=> array(
            'backgroundColor'=>'#AD76B2',
            'borderRadius'=>2,
            'borderWidth'=>0,
            'style' => array('padding' => '10px', 'color' => '#eee'),
            'headerFormat' => '<div style="font-size:1.2em; color: #fff; line-height: 22px ">{point.key}<br/></div>',
            'pointFormat' => '<div style="font-size:1.1em; color: #eee; ">{series.name}: <b>{point.y}</b></div>',
        ),
		'xAxis' => array(
			'categories'=>'yearmonth',
			'startOnTick'=> true,
			'min' => '0',
			'endOnTick'=> true,
		),
		'yAxis' => array(
			'title' => '',
			
		),
		'series' => array(
			array(
				'type' => 'areaspline',
				'name'=>'Leden',             //title of data
				'dataResource'=>'aantalLeden',
			)
		),
		'chart'=> array(
            'height'=>250,
            'width'=>300,
        ),
      'exporting' => array('enabled' => false),
      'theme' => 'elephant', 
      'legend' => false,
   )
));
$this->widget('common.extensions.highcharts.HighchartsWidget', array(
	'dataProvider'=>$dataProviderLedenGroepen,
	'template'=>'{items}',
	'id' => 'containerPie',
	'options'=>array(
		'title' => array('text' => 'Totaal leden groepen', 'style' => array('font-family' => '"Open Sans","Helvetica Neue", Helvetica, Arial, sans-serif', 'font-weight' => 'normal')),
		'tooltip'=> array(
            'backgroundColor'=>'#AD76B2',
            'borderRadius'=>2,
            'borderWidth'=>0,
            'style' => array('padding' => '10px', 'color' => '#eee'),
            'headerFormat' => '<div style="font-size:1.2em; color: #fff; line-height: 22px ">{point.key}<br/></div>',
            'pointFormat' => '<div style="font-size:1.1em; color: #eee; ">{series.name}: <b>{point.y}</b></div>',
        ),
		'plotOptions' => array( 
			'pie' => array(
				'allowPointSelect' => true,
				'cursor' => 'pointer',
				'dataLabels' => array(
					'enabled' => true,
					'color' => '#353535',
					'x' => '2',
					'formatter' => 'js:function(){
						return "<b>" + this.point.name + " - " +this.y +"</b>";
					}',
				),
			),
		),
		'series' => array(
			array(
				'type' => 'pie',
				'name'=>'Leden',
				'data'=>$TasksPriority,
			)
		),
		'chart'=> array(
            'height'=>250,
            'width'=>300,

        ),
      'exporting' => array('enabled' => false),
      'theme' => 'elephant', 
      'legend' => false,
   )
));