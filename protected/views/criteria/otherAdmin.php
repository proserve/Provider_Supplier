<?php echo '<h1>'.Yii::t('app1', 'Manage Criterias'). '</h1>' ?>

<?php
/*$var = array();
if(Yii::app()->user->name=='root'){
    $var = array( 'class' => 'bootstrap.widgets.TbButtonColumn');
}*/
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id' => 'criteria-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => "{items}\n{extendedSummary}",
    'columns' => array(
        'id',
        'name',
        'description',
        array('name' => 'markSum', 'header' => 'evaluation Percecent %', 'value' => '$data->criteriaPercent'),
        $var,
    ),
    'extendedSummary' => array(
        'title' => 'Importance',
        'columns' => array(
            'markSum' => array(
                'label' => 'pencent',
                'types' => array(
                    'markSum' => array('label' =>  Yii::t('app1', 'Mark') ),
                ),
                'class' => 'TbPercentOfTypeEasyPieOperation',
// you can also configure how the chart looks like
                'chartOptions' => array(
                    'barColor' => '#333',
                    'trackColor' => '#999',
                    'lineWidth' => 8,
                    'lineCap' => 'square'
                )
            )
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well pull-right',
        'style' => 'width:350px'
    ),
    'chartOptions' => array(
        'data' => array(
            'series' => array(
                array(
                    'name' => 'Importance',
                    'attribute' => 'markSum'
                )
            )
        ),
        'config' => array(
            'chart' => array(
                'width' => 800
            )
        )
    ),
));
?>
