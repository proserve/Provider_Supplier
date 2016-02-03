<?php
$ar = Criteria::model()->getCriteriaUpdateOptions();
     /*   array();
$o = 1;
foreach ( as $value) {
    $ar[$o - 1] = $value['name'];
    $o++;
}*/
?>
<?php echo '<h1>'.Yii::t('app1', 'Manage Criterias'). '</h1>' ?>

<?php
    $var = array(
        'name',
        'description',
        'markSum',
        array('name'=>'assignedCategorie',
                'filter'=>  CHtml::listData(Categorie::model()->findAll(array('order'=>'name ASC')), 'id', 'name'),
                'type'=>'html',
                'header' => 'Categorie', 
                'value' => '$data->relatedCategories',
    
                ),
    );
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id' => 'criteria-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'type'=>'striped bordered',
    'template' => "{items}\n{extendedSummary}",
    'columns' => $var,
    'chartOptions' => array(
        'data' => array(
            'series' => array(
                array(
                    'name' => Yii::t('app1', 'Mark'),
                    'attribute' => 'markSum'
                )
            )
        ),
        'config' => array(
            'chart'=>array(
                'type'=>'line',
                'width'=>'1100'
            ),
      'title' => array('text' => Yii::t('app', 'Criteria')),
      'xAxis' => array(
         'categories' => $ar,

      ),
      'yAxis' => array(
         'title' => array('text' => Yii::t('app1', 'Criteria importance'))
      ),
      
        'plotOptions'=>array(
                'line'=>array (
                    'dataLabels'=>array( 
                        'enabled'=>true
                    ),
                    'enableMouseTracking'=> false
                )
            ),
        ),
        'htmlOptions'=>array('style'=>'background-color: red')
    ),
));


?>
