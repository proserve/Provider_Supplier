<?php echo '<h1>'.Yii::t('app1', 'Manage Criterias'). '</h1>' ?>

<?php
    $var = array(
        'name',
        'description',
        array('name'=>'assignedCategorie',
                'filter'=>  CHtml::listData(Categorie::model()->findAll(array('order'=>'name ASC')), 'id', 'name'),
                'type'=>'html',
                'header' => 'Categorie', 
                'value' => '$data->relatedCategories',
    
                ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        )
    );

$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id' => 'criteria-grid',
    'dataProvider' => $model->search2(),
    'filter' => $model,
    'type'=>'striped bordered',
    'template' => "{items}\n{extendedSummary}",
    'columns' => $var,
));


?>
