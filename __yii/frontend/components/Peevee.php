<?php

Yii::import('zii.widgets.CPortlet');

class Peevee extends CPortlet
{
	//public $title='Recent Comments';
	public $maxComments=10;

	public function getRecentArticles() {
		return Content::model()->findRecentArticles($this->maxComments);
	}

	protected function renderContent() {
		$this->render('peevee');
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