
<h2> <?php echo Yii::t('app2', 'You will update your comparaison for')   . 
        $model->provider_a_id.' & '.$model->provider_b_id ;?> </h2>


<?php echo $this->renderPartial('_updateForm',array('model'=>$model)); ?>