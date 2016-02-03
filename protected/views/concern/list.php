<h1><?php echo Yii::t('app', 'Criterias Linked to This project')?></h1>
    <?php $var = Criteria::model()->getCriteriaUpdateOption();
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => Yii::t('app', 'Criterias Linked to This project'),
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <table class="table">
    <thead>
    <tr>
    <th>#</th>
    <th><?php echo Yii::t('app', 'Criteria') ?></th>
    <th><?php echo Yii::t('app', 'Categorie') ?></th>
    </tr>
    </thead>
    <tbody>
      
    
        <?php   
        $o = 1;
        foreach ($var as $value) {
           echo '<tr class="odd"><td>E'.$o.'</td><td>'.$value['name'].'</td><td>'. $value->getRelatedCategories().'</td></tr>' ;
           $o++;
           
        }
       
        ?>
   
    </tbody>
    </table>
    <?php $this->endWidget() ; ?>
 