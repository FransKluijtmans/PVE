<?php
Yii::import('zii.widgets.CPortlet');

class WidgetFormSteps extends CPortlet
{
        public function init()
        {
                //$this->title=Yii::t('user', 'Login');
                parent::init();
        }

        protected function renderContent()
        {
                $this->render('FormSteps');
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