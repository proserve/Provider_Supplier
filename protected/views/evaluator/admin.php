
<?php echo '<h1>'.Yii::t('app1', 'Manage Evaluators').'</h1>' ?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'evaluator-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'username',
        'fist_name',
        'last_name',
        'function',
        array('name'=>'assignedCategorie',
                'filter'=>  CHtml::listData(Categorie::model()->findAll(array('order'=>'name ASC')), 'id', 'name'),
                'type'=>'html',
                'header' => 'Categorie', 
                'value' => '$data->relatedCategories',
    
                ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
