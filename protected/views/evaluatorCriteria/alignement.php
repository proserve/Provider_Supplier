<?php echo '<h1>'.Yii::t('app1', 'Selected Criterias').'</h1>' ?>
    <?php $var = Criteria::model()->getSelectedCriteria();
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => Yii::t('app1', 'Selected Criterias'),
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <table class="table">
    <thead>
    <tr>
    <th>#</th>
    <th><?php echo Yii::t('app1', 'Criteria'); ?></th>
    <th><?php echo Yii::t('app1', 'Importance level %(Befor AL)'); ?></th>
    <th><?php echo Yii::t('app1', 'Importance level %(After AL)'); ?></th>
    </tr>
    </thead>
    <tbody>
      
    
        <?php   
        $o = 1;
        foreach ($var as $key=> $value) {
           echo '<tr class="odd"><td>C'.$o.'</td><td>'.
           Criteria::model()->findByPk($key)->name .
                   '</td><td>'.
                   round($value*100/EvaluatorCriteria::model()->getCriteriasMarksSum(),2).'<td>'.
                   round($value*100/Criteria::model()->getSelectedCriteriaSum(),2).'</td>'
                   . '<td></tr>' ;
           $o++;
           
        }
       
        ?>
   
    </tbody>
    </table>
    <?php $this->endWidget() ; ?>
