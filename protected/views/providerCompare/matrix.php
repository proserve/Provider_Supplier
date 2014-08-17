<?php
if (ProviderCompare::model()->ready()):
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => Criteria::model()->findByPk($criteriaID)->name . ' ' . Yii::t('app', 'Criteria'),
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table',)
    ));
    $matrix = ProviderCompare::model()->providersMatrixComp($criteriaID);
    $draw = Provider::model()->getProvidersTable();
    ?>
    <table class="table" style="color:#444;font-size: 18">
        <thead>
            <tr>
                <th><?php echo Yii::t('app2', 'Providers'); ?> </th>
                <?php
                foreach ($draw as $value) {
                    echo '<th>' . $value . '</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $test = '';
            // echo '<tfoot>';
            foreach ($draw as $value) {
                echo '<tr class="odd"><th>' . $value . '</th>';
                foreach ($draw as $value1) {
                    echo '<td>' . round($matrix[$value1][$value], 3) . '</td>';
                }
                echo '</tr>';
                $test .= '<td>' . round($matrix[$value]['sum'], 3) . '</td>';
            }
            echo '<tr><th>sum</th>' . $test . '</tr>';
            ?>

        </tbody>
    </table>
    <?php
    $this->endWidget();
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => Criteria::model()->findByPk($criteriaID)->name . ' Criteria',
        'headerIcon' => 'icon-th-list',
        'htmlOptions' => array('class' => 'bootstrap-widget-table')
    ));
    $matrix = ProviderCompare::model()->relativePoidMatrix($criteriaID, Yii::app()->user->getState('appelOffre'));
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
                echo '<th>' . Yii::t('app2', 'Sum') . '</th>';
                echo '<th>Poids Relatif</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $test = '';
            foreach ($draw as $value) {
                echo '<tr class="odd"><th>' . $value . '</th>';

                foreach ($draw as $value1) {
                    echo '<td>' . round($matrix[$value1][$value], 3) . '</td>';
                } echo '<td>' . round($matrix['poidRelative'][$value] * count($draw), 3) . '</td>';
                echo '<td>' . round($matrix['poidRelative'][$value], 3) . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>

    <?php
    $endWidget = $this->endWidget(); 
    
    elseif (!ProviderCompare::model()->ready()):
    $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
        'heading' => Yii::t('app3', 'COMPLETE ALL COMPARAISON'),
    ));
    echo '<p>';
    echo Yii::t('app2', 'TO VIEW THIS PAGE YOU HAVE TO COMPLETE THEME.');
    echo '</p><p>';
    $test = 'test';
    $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'size' => 'large',
        'label' => 'View report',
        'htmlOptions' => array(
            'onclick' => 'js:bootbox.alert("' . ProviderCompare::model()->getRestedComparaisonReport() . '")'
        ),
    ));
    echo '</p> ';
    $this->endWidget();

   elseif (is_array(ProviderCompare::model()->configureFinance())):

    $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
        'heading' => Yii::t('app3', 'COMPLETE Provider\'s financial offre configuration'),
    ));
    ?>

    <p><?php echo Yii::t('app2', 'TO VIEW THIS PAGE YOU HAVE TO COMPLETE THEME.') ?></p>
    <p>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'primary',
            'size' => 'large',
            'label' => 'View report',
            'htmlOptions' => array(
                'onclick' => 'js:bootbox.alert("' . ProviderCompare::model()->financialOffreConfiguration(ProviderCompare::model()->configureFinance()) . '")'
            ),
        ));
    $this->endWidget();
    endif;
    

