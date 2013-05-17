<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'activiteit-form',
	'enableAjaxValidation'=>false,
	'stateful'=>true,
    'type'=>'horizontal'
)); ?>
    <h3>Opties voor de activiteit - Stap 3</h3>
<?php $this->widget('bootstrap.widgets.TbProgress', array(
    'type'=>'info', // 'info', 'success' or 'danger'
    'percent'=>66, // the progress
    'striped'=>false,
    'animated'=>false,
)); ?>

	<?php echo $form->errorSummary($modelActiviteitOptions); ?>

	<?php 
        if(isset($model->aantalOpties)){
            for ($i = 0; $i < $model->aantalOpties; $i++){
                //echo $step. 'asdasd';
                $optionNumber = $i+1;
                echo "<h4>Optie - ".$optionNumber."</h4>";
                echo $form->textFieldRow($modelActiviteitOptions,'['.$optionNumber.']omschrijving');
                echo $form->textFieldRow($modelActiviteitOptions,'['.$optionNumber.']kosten',array('maxlength'=>5));
                echo $form->textFieldRow($modelActiviteitOptions,'['.$optionNumber.']maxInschrijvingLid',array('maxlength'=>2));
                echo $form->hiddenField($modelActiviteitOptions,'['.$optionNumber.']media_id',array('maxlength'=>5, 'id'=>'media'.$optionNumber,));
                //add modal button
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'',
                    'icon'=>'icon-plus icon-white',
                    'type'=>'primary',
                    //'url'=>Yii::app()->createUrl('leden/update', array('id' => 1013)),
                    'htmlOptions'=>array(
                        'data-toggle'=>'modal',
                        'data-target'=>'#myModal',
                        'onclick'=>'js:$("input#optionid").val("media'.$optionNumber.'")',//add optionid (as in mediaid) to this modal
                        'rel'=>'tooltip',
                        'data-original-title'=>'Media toevoegen',
                        'data-placement'=> 'right',
                    ),
                ));
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label'=>'',
                    'icon'=>'icon-minus icon-white',
                    'type'=>'primary',
                    //'url'=>Yii::app()->createUrl('leden/update', array('id' => 1013)),
                    'htmlOptions'=>array(
                        //'onclick'=>'js:$("input#optionid").val("media'.$optionNumber.'")',//add optionid (as in mediaid) to this modal
                        'rel'=>'tooltip',
                        'data-original-title'=>'Media verwijderen',
                        'data-placement'=> 'right',
                        'style'=>'display:none',
                        'id'=>'btnRemovemedia'.$optionNumber.''
                    ),
                ));
                ?>
                <div id='optionmedia<?php echo $optionNumber ?>' class="placeholdermediathumb"></div>
                <?php
            }
        } 
    ?>
	<hr />
	<?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Afronden',
        'icon'=>'arrow-right white',
        'loadingText'=>'verwerken...',
        'htmlOptions'=>array('id'=>'buttonStateful', 'name'=>'step4'),
    )); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'link',
        'label'=>'Terug naar stap 2',
        'htmlOptions'=>array('id'=>'buttonStateful', 'name'=>'step2back'),
    )); ?>

<?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal', 'htmlOptions'=>array('class'=>'modal--activity',))); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Media toevoegen</h3>
</div>
<div class="modal-body">
    <?php
    $dataProvider=new CActiveDataProvider('Media');
//$this->renderPartial('_form', array('model' => $model ));
    /*$dataProvider=new CActiveDataProvider('MediaTypes');
    $criteria = new CDbCriteria;
    //$criteria->with = 'user';
    //$criteria->compare('company_id', $id); //if error due to similar column name change it to t.company_id
    $dataProvider =  new CActiveDataProvider('MediaTypes', array(
                     'criteria' => $criteria,
                 ));*/
?>
<div class="row-fluid" id="mediaThumbsBody">
    <?php
    $this->renderPartial('//media/mediamodal', array('model' => Media::model(), 'dataProvider'=>$dataProvider, true ));
    ?>
</div>
<input type="hidden" name="optionid" id="optionid" value="" />
</div>
 
<div class="modal-footer">
    <?php /*$this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'button',
        'type'=>'primary',
        'label'=>'Toevoegen',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'buttonAddMediaArtivity'),
    ));*/ 
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'ajaxButton',
        'type'=>'primary',
        'label'=>'Toevoegen',
        'url'=>$this->createUrl('media/ajaxAddMediaRequest'),
        'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'buttonAddMediaArtivity'),
        'ajaxOptions'=>array(
            'type' => 'POST',
            'beforeSend' => '
                function( request ) {
                    //alert(request);
                }',
            'success' => 'function( data ) {
                //alert(data);
                //var idMediaItem = $(".selectedThumb").attr("id");
                //var idMedia = $("#optionid").val();
                //$("#"+idMedia).val(idMediaItem);

                //add value of selected media to hidden input in formstep3
                $("#"+$("#optionid").val()).val($(".selectedThumb").attr("id"));
                $( "#option"+$("#optionid").val() ).html(data);
                //alert( $("#optionid").val() );
                $( "#btnRemove"+$("#optionid").val() ).show();
                //alert( "#option"+$("#optionid").val() );
                //alert(data);
            }',
            'data' => array( 
                'mediaid' => 'js:$(".selectedThumb").attr("id")',
            )
        ),
    ));
    ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'type'=>'link',
        'label'=>'Annuleren',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'buttonCancelMediaArtivity'),
    )); ?>
</div>
<?php $this->endWidget(); 

//CVarDumper::dump($this->getPageState('step1',array()));
//echo '<br>';
//CVarDumper::dump($this->getPageState('step2',array()));
//echo $this->getPageState('step1',array());
//CVarDumper::dump($model->errors);
print_r( Yii::app()->session->get('step1') );
echo '<br>';
print_r( Yii::app()->session->get('step2') );
echo'<br>';
print_r( $model->attributes);
?>