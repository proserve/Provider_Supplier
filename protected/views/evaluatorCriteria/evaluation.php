<?php
        
$this->widget('zii.widgets.jui.CJuiTabs', array(
'options'=>array(
        'collapsible'=>true,
    ),
    
    'tabs'=>array(
        Yii::t('app','My evaluations') => array('ajax' => $this->createUrl('/evaluatorCriteria/otherAdmin')),
        Yii::t('app', 'Evaluate Criteria')=>array('ajax'=>$this->createUrl('/evaluatorCriteria/create')),
),
));
?>