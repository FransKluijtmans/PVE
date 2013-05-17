<?php
// datum: 16-03-2013
// author: rob kluytmans
// function: extending clistview to remove these tags [for clean markup]: 
//		<div id="yw0" class="list-view">
//		<div class="items">
//		<div title="/_pve_refactor/_pve/" style="display:none" class="keys">

Yii::import('zii.widgets.CListView');

class MListView extends CListView {
    public function run(){
		$this->registerClientScript();

		//echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";

		$this->renderContent();
		//$this->renderKeys();

		// echo CHtml::closeTag($this->tagName);
    }
}