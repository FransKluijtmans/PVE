<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,800,700italic,800italic' rel='stylesheet' type='text/css'>
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/style.css');?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="img/favicon.ico">
	
</head>
<body id="body-login">

<div class="container" id="page-login">

	<?php echo $content; ?>
    
</div><!-- page -->

<script type="text/javascript">
$('#buttonStateful').click(function() {
    var btn = $(this);
    btn.button('loading'); // call the loading function
    setTimeout(function() {
        btn.button('reset'); // call the reset function
    }, 10000);
});
</script>
</body>
</html>
