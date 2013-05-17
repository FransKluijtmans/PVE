<?php
$this->pageTitle=  'Login - ' . Yii::app()->name;
$this->breadcrumbs=array(
	'Login',
);
?>

<h1><?php echo Yii::app()->name; ?></h1>

<h4>Welkom.&nbsp;</h4><p>Log hier in:</p>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'inline',
    /*'htmlOptions'=>array('class'=>'well'),*/
	'inlineErrors'=>false,
	'enableClientValidation'=>true,
)); ?>

<?php echo $form->error($model,'username'); ?>
<?php echo $form->error($model,'password'); ?>
<?php echo $form->textFieldRow($model, 'username', array('class'=>'span2', 'prepend'=>'<i class="icon-user icon-white"></i>')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span2', 'prepend'=>'<i class="icon-lock icon-white"></i>')); ?>
<?php //echo $form->checkboxRow($model, 'rememberMe'); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'primary',
    'label'=>'Inloggen',
	'icon'=>'arrow-right white',
    'loadingText'=>'verwerken...',
    'htmlOptions'=>array('id'=>'buttonStateful'),
)); ?>
<?php $this->endWidget(); ?>
