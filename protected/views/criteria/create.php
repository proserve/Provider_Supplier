<?php echo '<h1>'.Yii::t('app1', 'Create new Criteria'). $model->name.'</h1>' ?>


<?php echo $this->renderPartial('_form',array(
    'model'=>$model,
    'categorie' => $categorie,
        )); ?>