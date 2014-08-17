<?php echo '<h1>'.Yii::t('app1', 'Update profile of evaluator: '). $model->username.'</h1>' ?>

<?php echo $this->renderPartial('_form',array(
    'model'=>$model,
    'categorie' => $categorie,
        )); ?>