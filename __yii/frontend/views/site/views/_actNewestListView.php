<?php
/* @var $this ActiviteitController */
/* @var $data Activiteit */
?>

<li class="view">

	<h2>uh<?php //$unixtime=CDateTimeParser::parse($data->datum,'dd/MM/yyyy'); echo str_replace('.', '', Yii::app()->dateFormatter->format('dd MMM',$unixtime) );?></h2>
	<span><?php  
foreach($data->activiteit as $activity)
   {
     echo CHtml::link($activity->naam, array("/activiteit/signup", "id"=>$activity->id));
   }

	; ?></span>
	<div class='applications'><i>12</i></div><!-- add how many responders -->
	<?php //echo $data->content->content; ?>

</li>