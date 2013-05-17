<?php
/* @var $this ActiviteitController */
/* @var $data Activiteit */
?>

<li class="view">
	<h2><?php $unixtime=CDateTimeParser::parse($data->datum,'dd/MM/yyyy'); echo str_replace('.', '', Yii::app()->dateFormatter->format('dd MMM',$unixtime) );?></h2>
	<span><?php echo CHtml::link($data->activiteit->naam, array("/activiteit/signup", "id"=>$data->activiteit->id)) ?></span>
	<div class='applications'><i>12</i></div><!-- add hhow many responders -->
	<?php //echo $data->content->content; ?>
</li>