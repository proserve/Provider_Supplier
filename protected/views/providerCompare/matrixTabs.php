
 <h1><?php echo Yii::t('app2', 'Final matrix') ; ?></h1>
<?php
  
$this->widget('bootstrap.widgets.TbTabs', array(
	'type'=>'pills', // 'tabs' or 'pills'
    'placement'=>'left',
	'tabs'=>$tab,
));
?>
