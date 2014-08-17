<h1><?php echo Yii::t('app', 'Evaluator Linked to This project')?></h1>
    <?php $var = Evaluator::model()->getEvaluatorUpdateOption();
    $ar =array();$data1 =array();$data2 =array();
    $chaine ='';
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => Yii::t('app', 'Evaluator Linked to This project'),
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <table class="table">
    <thead>
    <tr>
    <th>#</th>
    <th><?php echo Yii::t('app', 'Evaluator') ?></th>
    <th><?php echo Yii::t('app', 'Categorie') ?></th>
    </tr>
    </thead>
    <tbody>
      
    
        <?php   
        $o = 1;
        foreach ($var as $value) {
           echo '<tr class="odd"><td>E'.$o.'</td><td>'.$value['username'].'</td><td>'. $value->getRelatedCategories().'</td></tr>' ;
           $o++;
           
        }
       
        ?>
   
    </tbody>
    </table>
    <?php $this->endWidget() ; ?>
 