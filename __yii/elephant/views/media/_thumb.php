	<?php
	$posResult = strpos($data->tblMediaTypesMediaTypes->type, "/");
				$extResult = substr($data->tblMediaTypesMediaTypes->type, 0, $posResult);
	    		if($extResult == "image"){
					$img = '<img alt="'.$data->naam.'" src="'.Yii::app()->getBaseUrl().'/..'.$data->locatie.'thumb/'.$data->naam.'.'.$data->tblMediaTypesMediaTypes->extension.'" title="'.$data->naam.'" height="'.floor((180/$data->width)*$data->height).'" width="180">';
	    			$deleteicon = '<span class="deleteThumb" id="'.$data->id.'"><i class="icon-remove"></i></span>';
	    			$thumbObject = $deleteicon.$img;
	    		}elseif($extResult == "application"){ 
	    			if($data->tblMediaTypesMediaTypes->extension == "pdf"){
	    				$img = '<img alt="'.$data->naam.'" src="'.Yii::app()->getBaseUrl().'/img/pdf-icon.png" title="'.$data->naam.'" height="180" width="180">';
	    				$deleteicon = '<span class="deleteThumb" id="'.$data->id.'"><i class="icon-remove"></i></span>';
	    				$thumbObject = $deleteicon.$img;
	    			}elseif($data->tblMediaTypesMediaTypes->extension == "xls" || $data->tblMediaTypesMediaTypes->extension == "xlsx"){ 
	    				$img = '<img alt="'.$data->naam.'" src="'.Yii::app()->getBaseUrl().'/img/excel-icon.png" title="'.$data->naam.'" height="180" width="180">';
	    				$deleteicon = '<span class="deleteThumb" id="'.$data->id.'"><i class="icon-remove"></i></span>';
	    				$thumbObject = $deleteicon.$img;
	    			}elseif($data->tblMediaTypesMediaTypes->extension == "doc" || $data->tblMediaTypesMediaTypes->extension == "docx"){ 
	    				$img = '<img alt="'.$data->naam.'" src="'.Yii::app()->getBaseUrl().'/img/word-icon.png" title="'.$data->naam.'" height="180" width="180">';
	    				$deleteicon = '<span class="deleteThumb" id="'.$data->id.'"><i class="icon-remove"></i></span>';
	    				$thumbObject = $deleteicon.$img;
	    			}
	    		}
	    		?>
	<li>
		<div class="thumbnail">
	    	<?php 
				echo CHtml::ajaxLink(
	    			$deleteicon,
            		array('media/delete&ajax=media-grid&id='.$data->id),
					array(	
							'type' => 'POST',
							'update'=>'#thumbnails', 
							'idOfLink'=>'js:$(this).attr("id")',
    						'complete' => 'function(){
    							$("#sidebarMedia").empty();
    							$("#"+this.idOfLink).closest("li").fadeOut(300, function(){ 
    								$("#"+this.idOfLink).closest("li").remove();
								});
                            }'
    					),
					array('confirm'=>'Weet je zeker dat je dit wil verwijderen?')
        		);

	    		echo CHtml::ajaxLink(
	    			$img,
            		array('media/update&id='.$data->id),
					array(	'update'=>'#sidebarMedia', 
							'idOfLink'=>'js:$(this).attr("id")',
							'beforeSend' => 'function(xhr){
								if($("a#"+this.idOfLink).hasClass("selected")){
									xhr.abort();
									$("#sidebarMedia").empty();
                        			$("a").removeClass("selected");
                        			$("i").removeClass("icon-ok");
                        			$("span").removeClass("selectedThumb");
                        		}else{
                        			$("#sidebarMedia").empty();
                        			$("#sidebarMedia").prepend("<div class=\"loading-icon\"></div>");
                        			$("a").removeClass("selected");
                        			$("i").removeClass("icon-ok");
                        			$("span").removeClass("selectedThumb");
                        			$("#"+this.idOfLink).addClass("selected").prepend("<span class=\"selectedThumb\"><i class=\"icon-ok\"></i></span>");
                        		}
							}',
    						'complete' => 'function(){
    							$(".loading-icon").css("display", "none");
                            }'
    					)
        		);
				
			?>
	    	<h3><?php echo CHtml::encode($data->naam); ?></h3>
			<p><b><?php echo CHtml::encode($data->getAttributeLabel('extension')); ?>:</b>
			<?php echo CHtml::encode($data->tblMediaTypesMediaTypes->extension); ?>
			<br />
			</p>
	    </div>
	</li> 