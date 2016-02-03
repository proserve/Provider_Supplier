<?php echo '<h1>'.Yii::t('app1', 'Update Criteria: '). $model->name.'</h1>' ?>


<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'name',
        'description',
    ),
));
?>
