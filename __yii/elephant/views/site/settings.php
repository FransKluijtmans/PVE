<?php
$this->pageTitle=  'Instellingen - ' . Yii::app()->name;
?>

<h1>Instellingen - <?php echo $model->ledenPersoneelsnummer->achternaam; ?></h1>

<p>Welkom bij de instellingen pagina.</p>

<?php echo $this->renderPartial('//admin/_formUpdate', array('model'=>$model)); ?>
