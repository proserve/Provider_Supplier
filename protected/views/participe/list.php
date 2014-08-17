<h1><?php echo Yii::t('app', 'Providers participated to This project')?></h1>
    <?php $var = Provider::model()->getProviderUpdateOption();
    $vv = Participe::model()->findAll('appel_offre_id=:offre', 
            array(':offre'=>  Yii::app()->user->getState('appelOffre')));
    
    
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => Yii::t('app', 'Providers Linked to This project'),
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <table class="table">
    <thead>
    <tr>
    <th>#</th>
    <th><?php echo Yii::t('app', 'Provider') ?></th>
    <th><?php echo Yii::t('app3', 'Financial Offer')?></th>
    </tr>
    </thead>
    <tbody>
      
    
        <?php   
        $o = 1;
        foreach ($vv as $value) {
           echo '<tr class="odd"><td>P'.$o.'</td><td>'.$value['provider_id'].'</td>
               <td>'.$value['finance'].'</td></tr>' ;
           $o++;
           
        }
       
        ?>
   
    </tbody>
    </table>
    <?php $this->endWidget() ; ?>
 