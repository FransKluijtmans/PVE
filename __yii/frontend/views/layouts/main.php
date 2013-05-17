<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="language" content="nl" />
    <meta name="viewport" content="width=device-width, minimum-scale=1.0">
    
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="shortcut icon" href="img/favicon.ico">

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,200,200italic,300,300italic,400italic,600,600italic,900,900italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,800italic,800,700italic,700,600italic,300italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Sanchez:400,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700italic,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700italic,700,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Glegoo' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
</head>
<body>

<div class="page-container  wrapper">

	<div id="header">
		<div id="logo"><h1><?php echo CHtml::encode(Yii::app()->name); ?></h1></div>
	</div><!-- header -->

	<nav>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index'), 'active'=>Yii::app()->controller->id=='site'),
				array('label'=>'Activiteiten', 'url'=>array('/activiteit/'), 'active'=>Yii::app()->controller->id=='activiteit'),
				array('label'=>'Secties', 'url'=>array('/secties'), 'active'=>Yii::app()->controller->id=='secties'),
				array('label'=>'Nieuws', 'url'=>array('/content'), 'active'=>Yii::app()->controller->id=='content'),
				array('label'=>'Agenda', 'url'=>array('/agenda'), 'active'=>Yii::app()->controller->id=='agenda'),
				array('label'=>'Personeelsvereniging', 'url'=>array('/personeelsvereniging'), 'active'=>Yii::app()->controller->id=='personeelsvereniging'),
				array('label'=>'Service', 'url'=>array('/service/index'), 'visible'=>Yii::app()->user->isGuest, 'itemOptions'=>array('id'=>'service'), 'active'=>Yii::app()->controller->id=='service'),
				array('label'=>'Service ['.Yii::app()->session['volledigenaam'].']', 'url'=>array('/service/index'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions'=>array('id'=>'service'), 'active'=>Yii::app()->controller->id=='service')
			),
			//'type'=>'list',
			'htmlOptions'=>array('class'=>'nav  nav--block' ),
		)); ?>
	</nav><!-- mainmenu -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'homeLink' => '<li>'.CHtml::link('Personeelsvereniging', Yii::app()->homeUrl).'</li>',
			'links'=>$this->breadcrumbs,
			'tagName'=>'ul',
			'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
			'inactiveLinkTemplate'=>'<li class="breadcrumbs__inactive">{label}</li>',
			'separator' => '&#8594;',
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	
		<?php echo $content; ?>
	
	<div class="clear"></div>

	

</div><!-- page --> 
<footer>
	<div class='wrapper'>
		<ul class='nav-footer'>
			<li><h2>Personeelsvereniging</h2></li>
			<li><?php echo CHtml::link('Aanmelden',array('site/index')); ?></li>
			<li><?php echo CHtml::link('Contact',array('personeelsvereniging/contact')); ?></li>
			<li><?php echo CHtml::link('Documentatie',array('site/index')); ?></li>
		</ul>
		<ul class='nav-footer'>
			<li><h2>Service</h2></li>
			<li><?php echo CHtml::link('Wachtwoord vergeten',array('service/wachtwoordvergeten')); ?></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		<ul class='nav-footer'>
			<li><h2>Activiteiten</h2></li>
			<li><?php echo CHtml::link('Nieuwe activiteiten',array('activiteit/index')); ?></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</footer><!-- footer -->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/script.js',CClientScript::POS_END); ?>
</body>
</html>