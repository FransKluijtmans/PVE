<h3>Aanpassen media</h3>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label'=> 'Breedte',
            'value'=> $model->width.' px',
			'visible'=>!empty($model->width),
        ),
        array(
        	'label'=> 'Hoogte',
            'value'=> $model->height.' px',
			'visible'=>!empty($model->height),
        ),
		array(
            'label'=>'Soort',
            'value'=>CHtml::encode($model->tblMediaTypesMediaTypes->omschrijving),
        ),
		array(
            'label'=>'Datum - aangemaakt',
            'value'=>Yii::app()->dateFormatter->formatDateTime($model->datumAangemaakt,'long','medium'),
			'visible'=>!empty($model->datumAangemaakt),
        ),
		array(
            'label'=>'Naam - aangemaakt',
            'value'=>CHtml::encode($model->usersAangemaakt->voorletters).' '.CHtml::encode($model->usersAangemaakt->voorvoegsel).' '.CHtml::encode($model->usersAangemaakt->achternaam.' - '.$model->usersAangemaakt->personeelsnummer),
			'visible'=>!empty($model->datumAangemaakt),
        ),
	),
)); ?>
<hr>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'media-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'focus'=>array($model,'naam')
	)); 	
?>

	<?php echo $form->errorSummary($model); ?>
	<?php 
		if(isset($ajaxResponse)){
			if($ajaxResponse == 'succes'){ 
			echo '<div class="alert in alert-block fade alert-success"><strong>Goed gedaan!</strong> De aanpassing is doorgevoerd.</div>'; 
			}
		}
	?>

	<?php echo $form->textFieldRow($model,'naam',array('maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'title',array('maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'alt',array('maxlength'=>45));

 $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'ajaxSubmit',
		'type'=>'primary',
		'label'=>'Aanpassen',
		'icon'=>'arrow-right white',
		//'loadingText'=>'verwerken...',
		'htmlOptions'=>array('id'=>'buttonStatefulAjax'),
	    'ajaxOptions'=>array(
	    	'beforeSend' => 'function(){
				$("#buttonStatefulAjax").text("Verwerken...");
			}',//'complete'=>'function(html){$("#sidebarMedia").html("aa"+html);}',
			'success'=>'function(html){jQuery("#sidebarMedia").html(html)}',
			//'update'=>'#sidebarMedia',
			//'complete'=>'function(){
		    	//$("#buttonStatefulAjax").text("Aanpassen"),
		    	//$(".alert-success").remove();
		    	//$("#sidebarMedia hr").after(\'<div class="alert in alert-block fade alert-success"><strong>Goed gedaan!</strong> De aanpassing is doorgevoerd.</div>\');
		       //}',  		      
		),	
		'url'=>'index.php?r='.$_GET['r'].'&id='.$_GET['id'].'&_='.date("YmdHis")
	));	
 $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'ajaxSubmit',
		'type'=>'primary',
		//'label'=>'Verwijderen',
		'icon'=>'icon-trash icon-white',
		//'confirm'=>'Weet je zeker dat je dit wil verwijderen?',
		//'loadingText'=>'verwerken...',
		'htmlOptions'=>array('class'=>'buttonThumbDelete')
		)
		//'deleteConfirmation'=>"js:'Weet je zeker dat je '+$(this).parent().parent().children(':nth-child(1)').text()+' wil verwijderen?'",
		//'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',	
		//'url'=>'index.php?r='.$_GET['r'].'&id='.$_GET['id'].'&_='.date("YmdHis")
	);
$this->endWidget();