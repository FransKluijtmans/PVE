<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'activiteit-form',
	'enableAjaxValidation'=>false,
    'enableClientValidation'=> false,
	//'stateful'=>true,
    'type'=>'horizontal'
)); ?>
	<h3>Data voor de activiteit - Stap 2</h3>
<?php $this->widget('bootstrap.widgets.TbProgress', array(
    'type'=>'info', // 'info', 'success' or 'danger'
    'percent'=>33, // the progress
    'striped'=>false,
    'animated'=>false,
)); ?>

	<?php echo $form->errorSummary($modelActiviteitData); ?>

    <?php 
        if(isset($model->aantalData)){
           /* if(isset($_POST['step2back']) && $prepopulate){
                foreach(Yii::app()->session['step2'] as $i=>$arrayItem){
                    //echo $step. 'asdasd';
                    $dateNumber = $i;
                    echo "<h4>Datum - ".$dateNumber."</h4>";
                    echo $form->textField($modelActiviteitData, '[$dateNumber]datum') ; 
                 echo $form->label($modelActiviteitData, '[$dateNumber]datum') ; 
                 echo $form->error($modelActiviteitData, '[$dateNumber]datum'); 
                   // echo $form->datepickerRow($modelActiviteitData, '['.$dateNumber.']datum', array('prepend'=>'<i class="icon-calendar"></i>', 'options'=>array('format' => 'dd-mm-yyyy'), 'id'=>'datepicker'.$dateNumber, 'class'=>'input-small', 'value'=>$arrayItem['datum']));
                   // echo $form->timepickerRow($modelActiviteitData, '['.$dateNumber.']tijdstip', array('append'=>'<i class="icon-time" style="cursor:pointer"></i>', 'id'=>'timepicker'.$dateNumber, 'class'=>'input-small', 'options'=>array('showMeridian' => false, 'defaultTime'=>false), 'value'=>$arrayItem['tijdstip']));
                    //echo $form->textFieldRow($modelActiviteitData,'['.$dateNumber.']maxInschrijving',array('maxlength'=>2, 'class'=>'input-small', 'value'=>$arrayItem['maxInschrijving']));
                }
            }else{*/
                echo $model->aantalData;
                for ($i = 1; $i <= $model->aantalData; $i++){
                    //echo $step. 'asdasd';
                    $dateNumber = $i;
                    echo "<h4>Datum - ".$dateNumber."</h4>";
                    echo $form->datepickerRow($modelActiviteitData, '['.$dateNumber.']datum', array('prepend'=>'<i class="icon-calendar"></i>', 'options'=>array('format' => 'dd-mm-yyyy'), 'id'=>'datepicker'.$dateNumber, 'class'=>'input-small'));
                    echo $form->timepickerRow($modelActiviteitData, '['.$dateNumber.']tijdstip', array('append'=>'<i class="icon-time" style="cursor:pointer"></i>', 'id'=>'timepicker'.$dateNumber, 'class'=>'input-small', 'options'=>array('showMeridian' => false, 'defaultTime'=>false)));
                    echo $form->textFieldRow($modelActiviteitData,'['.$dateNumber.']maxInschrijving',array('maxlength'=>2, 'class'=>'input-small'));
                }
            //}
        }  
    ?>
	<hr />
	<?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Naar stap 3',
        'icon'=>'arrow-right white',
        'loadingText'=>'verwerken...',
        'htmlOptions'=>array('id'=>'buttonStateful', 'name'=>'step3'),
    )); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'link',
        'label'=>'Terug naar stap 1',
        'htmlOptions'=>array('id'=>'buttonStateful', 'name'=>'step1'),
    )); ?>

<?php $this->endWidget(); 

//CVarDumper::dump($model->attributes);
echo '<br>';
//CVarDumper::dump($this->getPageState('step2',array()));
echo'<br>';
//print_r( Yii::app()->session->get('result') );
//print_r( Yii::app()->session['result']['groepen'] );
print_r( Yii::app()->session->get('step2'));
echo'<br>a';
print_r( $modelActiviteitData->attributes);?>