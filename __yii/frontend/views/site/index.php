 <script>
$(function() {
	$( "#tabs" ).tabs({
		beforeLoad: function( event, ui ) {
			ui.jqXHR.error(function() {
				ui.panel.html(
					"Deze tab kon niet geladen worden. We proberen dit zo snel mogelijk op te lossen. " );
			});
		}
	});
	// move the nav to the bottom
	$( ".tabs" ).appendTo( "#tabs" );
});
</script>
<div class='home'>
        
	<div class='grid  two-thirds  home-content'>
		<!-- <h1><?php //$this->pageTitle=Yii::app()->name; ?></h1> -->
		<div class="activiteitenOverzicht">
			<div id="tabs">
				<ul class="tabs">
					<li><a href="#tabs-1">Populairste activiteiten</a></li>
					<li><a href="index.php?r=site/newest">Nieuwste activiteiten</a></li>
				</ul>
				<div id="tabs-1">
					<?php $this->widget('frontend.components.MListView', array(
						'dataProvider'=>$actdataProvider,
						'itemView'=>'views/_actListView',
						'itemsTagName'=>'ul',
						'itemsCssClass'=>'actOverviewList',
						'template' => '{items}',
					)); ?>	
				</div>
			</div>
		</div>
		<?php $this->widget('frontend.components.MListView', array(
			'dataProvider'=>$newsdataProvider,
			'itemView'=>'views/_view',
			'itemsTagName'=>'ul',
			'itemsCssClass'=>'overviewList',
			'template' => '{items}{pager}',
			'pager'=>array('class'=>'TbPager'),
		)); ?>
	</div><!-- /content -->
		        
	<div class='grid  one-third  sub-content'>
			<?php 
				if(Yii::app()->user->isGuest) {
					$this->widget('LoginWidget'); 
				}else{
					$this->renderPartial('_loggedin');
				}

				$this->widget('Peevee', array(
					'maxComments'=>10,
				)); 
			?>
	</div><!-- /sub-content -->

</div><!-- /wrapper -->