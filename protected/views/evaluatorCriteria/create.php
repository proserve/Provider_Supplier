<?php echo '<h1>'.Yii::t('app1', 'Evaluate criterias'). '</h1>' ?>
<?php 
echo $this->renderPartial('_form', array('model'=>$model)); ?>
