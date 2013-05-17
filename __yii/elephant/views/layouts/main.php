<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="nl" />

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,800,700italic,800italic' rel='stylesheet' type='text/css'>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style.css');?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="img/favicon.ico">
</head>

<body>
<!--	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
<!--
	<div id="mainmenu">
		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
        <?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Groepen', 'url'=>array('/groepen'), 'active'=>Yii::app()->controller->id=='groepen'),
				array('label'=>'Leden', 'url'=>array('/leden'), 'active'=>Yii::app()->controller->id=='leden'),
				array('label'=>'Secties', 'url'=>array('/secties'), 'active'=>Yii::app()->controller->id=='secties'),
				array('label'=>'Admin', 'url'=>array('/admin'), 'active'=>Yii::app()->controller->id=='admin'),
			),
			'htmlOptions'=>array('class'=>'nav nav-list' ),
		));*/ ?>
	</div>-->
    <?php $this->widget('bootstrap.widgets.TbNavbar', array(
		'type'=>'null', // null or 'inverse'
		'brand'=>CHtml::encode(Yii::app()->name),
		'brandUrl'=>array('/site'),
		'fluid'=>true,
		'collapse'=>true, // requires bootstrap-responsive.css
		'items'=>array(
			/*array(
				'class'=>'bootstrap.widgets.TbMenu',
				'items'=>array(
					array('label'=>'Groepen', 'url'=>array('/groepen'), 'active'=>Yii::app()->controller->id=='groepen'),
					array('label'=>'Leden', 'url'=>array('/leden'), 'active'=>Yii::app()->controller->id=='leden'),
					array('label'=>'Secties', 'url'=>array('/secties'), 'active'=>Yii::app()->controller->id=='secties'),
					array('label'=>'Admin', 'url'=>array('/admin'), 'active'=>Yii::app()->controller->id=='admin'),
				),
			),*/
			//'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
			array(
				'class'=>'bootstrap.widgets.TbMenu',
				'htmlOptions'=>array('class'=>'pull-right'),
				'items'=>array(
					array('label'=>Yii::app()->session['volledigenaam'], 'url'=>'#', 'items'=>array(
						array('label'=>'Instellingen', 'url'=>array('/site/settings&id='.Yii::app()->session['id'].''), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'cog'),
						'---',
						array('label'=>'Inloggen', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Uitloggen ('.Yii::app()->session['volledigenaam'].')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'icon-off'),
						
					)),
				),
			),
		),
	)); ?><!-- /mainmenu -->

	<!-- sidemenu -->
	<nav class="side-navbar">
		<div class="row-fluid">
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
	        'type'=>'list',
			'htmlOptions'=>array('class'=>'side-main-navbar' ),
			'items'=>array(
					array('label'=>'Artikelen', 'url'=>array('/content'), 'active'=>Yii::app()->controller->id=='content', 'visible'=>Yii::app()->user->checkAccess('content.*')),
					array('label'=>'Activiteiten', 'url'=>array('/activiteit'), 'active'=>Yii::app()->controller->id=='activiteit', 'visible'=>Yii::app()->user->checkAccess('activiteit.*')),
					array('label'=>'Media', 'url'=>array('/media'), 'active'=>Yii::app()->controller->id=='media', 'visible'=>Yii::app()->user->checkAccess('media.*')),
					array('label'=>'Groepen', 'url'=>array('/groepen'), 'active'=>Yii::app()->controller->id=='groepen', 'visible'=>Yii::app()->user->checkAccess('groepen.*')),
					array('label'=>'Leden', 'url'=>array('/leden'), 'active'=>Yii::app()->controller->id=='leden', 'visible'=>Yii::app()->user->checkAccess('leden.*')),
					array('label'=>'Secties', 'url'=>array('/secties'), 'active'=>Yii::app()->controller->id=='secties', 'visible'=>Yii::app()->user->checkAccess('secties.*')),
					array('label'=>'Admin', 'url'=>array('/admin'), 'active'=>Yii::app()->controller->id=='admin', 'visible'=>Yii::app()->user->checkAccess('admin.*')),
					array('label'=>'Admin', 'url'=>array('/admin/update&id='.Yii::app()->session['id']), 'active'=>Yii::app()->controller->id=='admin', 'visible'=>!Yii::app()->user->checkAccess('admin')),
					array('label'=>'Categorie', 'url'=>array('/contentcategory'), 'active'=>Yii::app()->controller->id=='contentcategory', 'visible'=>Yii::app()->user->checkAccess('contentcategory.*')),
					array('label'=>'CSPA', 'url'=>array('/ledencspa'), 'active'=>Yii::app()->controller->id=='ledencspa', 'visible'=>Yii::app()->user->checkAccess('secties.*')),
					array('label'=>'Autorisatie', 'url'=>array('/auth'), 'active'=>Yii::app()->controller->id=='auth', 'visible'=>Yii::app()->user->checkAccess('auth.*')),
					array('label'=>'Agenda', 'url'=>array('/agenda'), 'active'=>Yii::app()->controller->id=='agenda', 'visible'=>Yii::app()->user->checkAccess('agenda.*')),
				),
	    )); ?>
	    <!-- page actionmenu -->
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
	        'type'=>'list',
			'htmlOptions'=>array('class'=>'side-sub-navbar' ),
			'items'=>$this->menu
	    )); ?>
	    <!-- /page actionmenu -->
	</div>
	</nav>
		<!-- /sidemenu -->
<div class="container-fluid" id="page">
    <div class="row-fluid">
		<!-- page -->
		<div class="span12">
		<?php echo $content; ?>
        <!--<div class="clear"></div>

		</div>
		<!-- /page -->
	</div>
</div>
<script type="text/javascript">
$('#buttonStateful').click(function() {
    var btn = $(this);
    btn.button('loading'); // call the loading function
    setTimeout(function() {
        btn.button('reset'); // call the reset function
    }, 3000);
});
$('#buttonStatefulAjax').click(function() {
    var btn = $(this);
    btn.button('loading'); // call the loading function
    setTimeout(function() {
        btn.button('reset'); // call the reset function
    }, 30000);
});

	$("ul.side-sub-navbar").children('li').children('a').contents(':not(i)').wrap('<span class="side-bar-text">');
	$("ul.side-sub-navbar").children('li').children('a').attr('rel','tooltip');
	$("ul.side-sub-navbar").children('li').children('a').each(function(){
		$text = $(this).contents(':not(i)').text();
		$(this).attr('data-original-title', $text);
	});
	$("ul.side-sub-navbar").children('li').children('a').attr('data-placement','right');
</script>
</body>
</html>
