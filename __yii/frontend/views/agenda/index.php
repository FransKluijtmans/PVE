<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/js/fullcalendar/fullcalendar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/js/fullcalendar/fullcalendar.print.css" media="print" />
<!-- <script type="text/javascript" src="/_pve_refactor/__yii/frontend/lib/fullcalendar/fullcalendar/fullcalendar.min.js"></script> -->
<?php
/* @var $this AgendaController */

$this->breadcrumbs=array(
	'Agenda',
);
?>
<h1>Activiteitenagenda</h1>


<script type='text/javascript'>
 
$(document).ready(function() {
 
$('#calendar').fullCalendar({
  header: {
    left: '',//'prev,next today',
    center: 'title',
    right: 'prev,next today',//'month,agendaWeek,agendaDay'
  },
  weekMode: 'liquid',
  editable: false,
  events: [
 
<?php 
  foreach ($model->search()->getData() as $event) {
    $year_created = date("Y", strtotime($event->datum));
    $month_created = date("m", strtotime($event->datum)) - 1;
    $day_created = date("d", strtotime($event->datum));
    //$hour_created = date("H", strtotime($event->id));
    //$min_created = date("i", strtotime($event->id));
    echo "{";
    echo "title: '" . $event->omschrijving .   "',";
    //echo "start: new Date(" . $year_created . "," . $month_created . "," . $day_created . "," . $hour_created . "," . $min_created . "),";
    echo "start: new Date(" . $year_created . "," . $month_created . "," . $day_created . "),";
    echo "allDay: false,";
    echo "url: '" . Yii::app()->createUrl("content/view", array("id"=>$event->id)) . "'";
    echo "},";
  }
?>
 
]
});
});
</script>
 
<div id='calendar'></div>