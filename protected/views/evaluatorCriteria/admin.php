<?php echo '<h1>'.Yii::t('app1', 'Manage evaluations'). '</h1>';

$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array('name'=>'criteria_search', 'header'=>'Criteria', 'value'=>'$data->criteria->name'),
        'mark',
       array('name'=>'active','header' =>'status', 'value'=> '$data->activationStatus'),
       array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
              'template' => '{delete} {update}',
        ),
    ),
));

?>
    