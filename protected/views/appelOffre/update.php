        <?php echo '<h1>'.Yii::t('app1', 'Update the project: ')  . $model->titre . '</h1>'; ?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>