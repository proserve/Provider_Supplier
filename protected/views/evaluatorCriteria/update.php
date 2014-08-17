
<?php echo '<h1>'.Yii::t('app1', 'You will update your evaluation of '). 
        Criteria::model()->findByPk($model->criteria_id)->name.'</h1>' ?>



<?php echo $this->renderPartial('_formWithoutCriteria',array('model'=>$model)); ?>