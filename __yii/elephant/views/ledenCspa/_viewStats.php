<ul class="cspaStats">
	<li>Laatste upload: 25 februari 2001</li>
    <li><?php echo CHtml::link($this->getStats('newmembers'), array('/ledencspa/newmembers'), array('class' => 'clearfix')); ?><span>Aantal nieuwe leden</span></li>
    <li><?php echo CHtml::link($this->getStats('newpersonel'), array('/ledencspa/newpersonel'), array('class' => 'clearfix')); ?><span>Aantal nieuwe medewerkers (geen pv leden)</span></li>
    <li><?php echo CHtml::link($this->getStats('leavingmembers'), array('/ledencspa/leavingmembers'), array('class' => 'clearfix')); ?><span>Aantal vertrokken medewerkers (pv leden)</span></li>
    <li><?php echo CHtml::link($this->getStats('notvalidatedcspa'), array('/ledencspa/notvalidatedcspa'), array('class' => 'clearfix')); ?><span>Aantal niet succesvol ingelezen medewerkers</span></li>
</ul>                