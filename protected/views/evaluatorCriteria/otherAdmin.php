<?php 
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Selected Criterias',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <table class="table">
    <thead>
    <tr>
        <th><?php echo Yii::t('app', 'Criteria') ?></th>
    <th><?php echo Yii::t('app1', 'Mark') ?></th>
    <th><?php echo Yii::t('app', 'Update').' & '.  Yii::t('app', 'Delete')?> & </th>
    </tr>
    </thead>
    <tbody>
      
    
        <?php   foreach ($var as $value) {
            $var1 = Criteria::model()->findByPk($value['criteria_id']);
           echo '<tr class="odd">'
                   . '<td>'.$var1['name'].'</td>'
                   . '<td>'.$value['mark'].'</td>'
                   . '<td><a class="update" rel="toltip" title="Update" href="?r=evaluatorCriteria/update&id[evaluator_id]='.
                   $idEva.'&id[criteria_id]='.$value['criteria_id'].'"><i class="icon-pencil"></i></a>   '
                   . '      <a  class="delete" rel="toltip" title="Delete" href="?r=evaluatorCriteria/delete&id[evaluator_id]='.
                   $idEva.'&id[criteria_id]='.$value['criteria_id'].'"><i class="icon-trash"></i></a>'
                   . '</td>'
                   . '</tr>' ;
        }
        ?>
   <?php 
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 1500).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
 <div class="flash-success">
     <?php

$this->widget('bootstrap.widgets.TbAlert', array(
'block'=>true, // display a larger alert block?
'fade'=>true, // use transitions?
'closeText'=>'×', // close link text - if set to false, no close link is displayed
'alerts'=>array( // configurations per alert type
'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
),
));?>
    </tbody>
    </table>
    <?php $this->endWidget();?>