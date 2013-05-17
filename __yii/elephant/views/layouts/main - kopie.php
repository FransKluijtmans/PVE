<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="nl" />

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,800,700italic,800italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>



<!--	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
<!--
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
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
						array('label'=>'Instellingen', 'url'=>array('/admin'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'cog'),
						'---',
						array('label'=>'Inloggen', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Uitloggen ('.Yii::app()->session['volledigenaam'].')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'icon'=>'icon-off'),
						
					)),
				),
			),
		),
	)); ?><!-- /mainmenu -->
	
<div class="container-fluid" id="page">
    <div class="row-fluid">
      <div class="span2  side-navbar">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
        'type'=>'list',
		'htmlOptions'=>array('class'=>'side-navbar' ),
		'items'=>array(
				array('label'=>'Artikelen', 'url'=>array('/content'), 'active'=>Yii::app()->controller->id=='content'),
				array('label'=>'Media', 'url'=>array('/media'), 'active'=>Yii::app()->controller->id=='media'),
				array('label'=>'Groepen', 'url'=>array('/groepen'), 'active'=>Yii::app()->controller->id=='groepen'),
				array('label'=>'Leden', 'url'=>array('/leden'), 'active'=>Yii::app()->controller->id=='leden'),
				array('label'=>'Secties', 'url'=>array('/secties'), 'active'=>Yii::app()->controller->id=='secties'),
				array('label'=>'Admin', 'url'=>array('/admin'), 'active'=>Yii::app()->controller->id=='admin'),
				array('label'=>'Categorie', 'url'=>array('/contentcategory'), 'active'=>Yii::app()->controller->id=='contentcategory'),
			),
    )); ?><!-- /sidemenu -->
    <?php $this->widget('bootstrap.widgets.TbMenu', array(
        'type'=>'list',
		'htmlOptions'=>array('class'=>'side-sub-navbar' ),
		'items'=>$this->menu
    )); ?><!-- /sidemenu -->
      </div>
      <div class="span10">
	<?php echo $content; ?>
        <!--<div class="clear"></div>
    
        <div id="footer">
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
        </div>--><!-- footer -->
      </div>
    </div>
</div><!-- page -->
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
</script>
<script type="text/javascript" src="js/jquery.passwordStrenghCheck.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#Admin_wachtwoord").passwordCheck();
	$("ul.side-sub-navbar").children('li').children('a').contents(':not(i)').wrap('<span class="side-bar-text">');
	$("ul.side-sub-navbar").children('li').children('a').attr('rel','tooltip');
	$("ul.side-sub-navbar").children('li').children('a').each(function(){
		$text = $(this).contents(':not(i)').text();
		$(this).attr('data-original-title', $text);
	});
	$("ul.side-sub-navbar").children('li').addClass('close-toggle');
	$("ul.side-sub-navbar").children('li:last-child').children('a').addClass('open-hide-toggle').removeAttr('href');
	$("ul.side-sub-navbar").children('li').children('a').attr('data-placement','right');

	$('a.open-hide-toggle').click(function() {
	    $this = $('ul.side-sub-navbar');//HOOGTE VERSCHIL AANPAKKEN!
	    if (!$this.is('.open-bar')) {
			$parentWidth = $this.parent().width();
			$newWidth = $parentWidth * 2;
			$nextParentWidth = $this.parent().next('div').width();
			$nextNewWidth = ($nextParentWidth/11)*10;
			$this.parent().removeClass('span1');
			$this.parent().addClass('span2');
			$this.parent().next('div').removeClass('span11');
			$this.parent().next('div').addClass('span10');
	        $this.addClass('open-bar');
			$("ul.side-sub-navbar").children('li').children('a').removeAttr('data-original-title');
			$("ul.side-sub-navbar").children('li:last-child').children('a').children('.side-bar-text').text(' Sluiten');
			$("ul.side-sub-navbar").children('li:last-child').children('a').children('i').addClass('icon-chevron-left').removeClass('icon-chevron-right');
	        $(".side-sub-navbar").animate({width: "168"}, { duration: 400, queue: false });
			setTimeout(function (){
				$('.side-bar-text').css('display','inline');//zorg dat nav item niet meer beweegt (hoogte)
				$("ul.side-sub-navbar").children('li').removeClass('close-toggle');
			}, 300);
	    }else{
			$('.side-bar-text').css('display','none');
			$this.removeClass('open-bar');
			$("ul.side-sub-navbar").children('li:last-child').children('a').children('.side-bar-text').text(' Open');
			$("ul.side-sub-navbar").children('li:last-child').children('a').children('i').removeClass('icon-chevron-left').addClass('icon-chevron-right');
			$(".side-sub-navbar").animate({width: "44"}, { duration: 400, queue: false });
			$("ul.side-sub-navbar").children('li').addClass('close-toggle');
			setTimeout(function (){

				$this.parent().removeClass('span2');
				$this.parent().addClass('span1');
				
				$this.parent().next('div').removeClass('span10');
				$this.parent().next('div').addClass('span11');

	         }, 250);
			$("ul.side-sub-navbar").children('li').children('a').each(function(){
				$text = $(this).contents(':not(i)').text();
				$(this).attr('data-original-title', $text);
			});
		}
	});
});
</script>
</body>
</html>
