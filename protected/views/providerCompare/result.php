<?php if (ProviderCompare::model()->ready()): 
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => Yii::t('app2', 'Final matrix') ,
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
    ));
    $matrix = ProviderCompare::model()->finaleMatrix();
    $draw = Provider::model()->getProvidersTable();
    ?>
    <table class="table">
        <thead>
            <tr>
                <th><?php echo Yii::t('app2', 'Providers'); ?> </th>
    <?php
    foreach ($draw as $value) {
        echo '<th>' . $value . '</th>';
    }
    ?>
                <th><?php echo Yii::t('app2', 'Sum')?></th>
            </tr>
        </thead>
        <tbody>
                <?php
                $bool = 1;
                $test = '';
                foreach ($matrix as $key => $value) {
                    if ($key != 'SUM') {
                        if($key == 'point financière')
                            $key = 'point financier';
                        echo '<tr class="odd"><th>' . $key . '</th>';
                        $bool = 1;
                        foreach ($value as $key1 => $value1) {
                            echo '<td>' . round($value1, 3) . '</td>';
                        }
                        echo '</tr>';
                    }
                }
              
                ?>
        </tbody>
    </table>    
            <?php $this->endWidget(); 
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => Yii::t('app2', 'Result Matrix'),
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
    ));
 
    $matrix = ProviderCompare::model()->poidRelativeSums(Yii::app()->user->getState('appelOffre'));
    $draw = Provider::model()->getProvidersTable();
    ?>
    <table class="table">
        <thead>
            <tr>
                <th><?php echo Yii::t('app2', 'Providers'); ?></th>
                <?php
                foreach ($draw as $value) {
                    echo '<th>' . $value . '</th>';
                }
                ?>
                <th><?php echo Yii::t('app2', 'Sum')?></th>
            </tr>
        </thead>
        <tbody>
    <?php
    $bool = 1;
    $test = '';
    foreach ($matrix as $key => $value) {
        if ($key != 'SUM') {
            echo '<tr class="odd"><th>' . $key . '</th>';
            $bool = 1;
            foreach ($value as $key1 => $value1) {
                echo '<td>' . round($value1, 3) . '</td>';
            }
            echo '</tr>';
        }
    }
    ?>
        </tbody>
    </table>
            <?php $this->endWidget();  else : 
            $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
                'heading' => Yii::t('app3', 'COMPLETE ALL COMPARAISON') ,
            ));
            ?>

<p><?php echo Yii::t('app2', 'TO VIEW THIS PAGE YOU HAVE TO COMPLETE THEME.') ?></p>
    <p>
    <?php
    $test = 'test';
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'size' => 'large',
        'label' =>  Yii::t('app2', 'View report') ,
        'htmlOptions' => array(
            'onclick' => 'js:bootbox.alert("' . ProviderCompare::model()->getRestedComparaisonReport() . '")'
        ),
    ));
    ?>
    </p> 

        <?php $this->endWidget();  endif ?>

    