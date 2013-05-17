  <?php 
  //echo $models->tblMediaTypesMediaTypes->id/*.$models->tblMediaTypesMediaTypes*/;
  $filenames =MediaTypes::model()->findAll();
  $myArray = array();
  foreach($filenames as $filename) {
    $posResult = strpos($filename->type, "/");
    $extResult = substr($filename->type, 0, $posResult);
    //if(is_array($myArray)){
    if(!in_array($filename->id, $myArray, true)){ 
      //array_push($myArray, $extResult );
      $myArray[$filename->id]=$filename->omschrijving;
    }
  };
   /* $posResult = strpos($models->tblMediaTypesMediaTypes->type, "/");
    $extResult = substr($models->tblMediaTypesMediaTypes->type, 0, $posResult);
      if($extResult == "image"){
        echo "<li><a href=''><img src='".Yii::app()->getBaseUrl()."/../_pve/elephant/img/elephant-logo.png' /></a></li>";
      }
  ?>
  <?php $this->widget('bootstrap.widgets.TbGridView',array(
  'dataProvider'=>$dataProvider,
  'columns'=>array(
    
            'type'
       ) 
)); */
?>
  <ul class='listMediatype'>
  <?php
    foreach ($myArray as $key => $value) {
      echo '<li>'.
        CHtml::ajaxLink(
        $value,
        Yii::app()->createUrl( 'media/ajaxArticleMediaRequest' ),
          array( // ajaxOptions
            'type' =>'POST',
            'beforeSend' => "function( request )
                           {
                             // Set up any pre-sending stuff like initializing progress indicators

                           }",
            'success' => "function( data )
                        {
                          // handle return data
                          //alert( data );
                          $('#mediaThumbsBody').empty();
                           $('#mediaThumbsBody').prepend(data);
                        }",
            'data' => array( 'mediaTypesId' => ''.$key.'')
          ),
          array( //htmlOptions
            'href' => Yii::app()->createUrl( 'media/ajaxArticleMediaRequest' ),
          )
      ).'</li>';
    }
  ?>
  </ul>
  <div class="span9">
    <?php
    $this->widget('bootstrap.widgets.TbThumbnails', array(
        //'dataProvider'=>$models->search(),
        'dataProvider'=>$dataProvider,
        'template'=>"{items}\n{pager}",
        'itemView'=>'//media/_thumbmodal',
    )); ?>
  </div>