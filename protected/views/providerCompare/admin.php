<h1><?php echo Yii::t('app2', 'Manage comparaisons') ; ?></h1>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array('name'=>'criteria1','value'=>'$data->criteria->name'),
        'provider_a_id',
        'comp',
        'provider_b_id',
        'mark',
        
       array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
           'template' => '{update}{delete}'
        ),
    ),
));

?>
    