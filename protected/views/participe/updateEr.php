<h1><?php echo Yii::t('app', 'Add Criterias to this project');?></h1>
<?php
$this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
   'heading' => Yii::t('app2', 'Ooops!   you haven\'t add any provider to this project') ,
    'headingOptions' => array('style'=>'font-size: 28px'),
));
echo '<br>';
 $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'primary',
    'size'=>'large',
    'label'=>Yii::t('app2', 'View providers that you can add'),
            'htmlOptions'=>array(
	  'onclick'=>'js:bootbox.alert("'.implode('<br>', Provider::model()->getRestedProvider()).'")'
  ),
));

$this->endWidget();
?>
