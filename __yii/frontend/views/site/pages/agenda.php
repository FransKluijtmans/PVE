<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>Agenda</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <tt><?php echo __FILE__; ?></tt>.</p>
<ul>
    <li>
        <a href="<?php echo $this->createUrl('/cal', array('layout' => 'column1')); ?>">
            Single column layout
        </a>
    </li>
</ul>