<?php

Yii::import('zii.widgets.CPortlet');

class SubnavSecties extends CPortlet
{
	public $sectieid;

	public function getSubNav() {
		return SectiesHasNavigation::model()->findSubnavSecties($this->sectieid);
	}

	protected function renderContent() {
		$this->render('subNavSecties');
	}

	public function run() {
    	$this->renderContent();
    	$content=ob_get_clean();
    	if($this->hideOnEmpty && trim($content)==='')
        	return;
    	//echo $this->_openTag; => removing the yii markup
    	echo $content;
    	//echo "</div>\n"; => removing the yii markup
    	//echo CHtml::closeTag($this->tagName); => removing the yii markup
	}
}