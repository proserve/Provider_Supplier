<?php

$this->widget('zii.widgets.jui.CJuiTabs', array(
'tabs'=>array(
    Yii::t('app', 'Evaluate Criteria')=>array('ajax'=>$this->createUrl('/evaluatorCriteria/create')),
    Yii::t('app','My evaluations') => array('ajax' => $this->createUrl('/evaluatorCriteria/otherAdmin')),
),
));
?>
