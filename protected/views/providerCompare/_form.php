
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'provider-compare-_form-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => FALSE,
        'htmlOptions' => array('class' => 'well'), 'type' => 'horizontal',
    ));
    ?>

<?php echo '<p class="help-block">' . Yii::t('app', 'Fields with') . 
        ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '.</p><br>' ?>

    <div class="flash-Error">
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'block' => true, // display a larger alert block?
            'fade' => true, // use transitions?
            'closeText' => '×', // close link text - if set to false, no close link is displayed
            'alerts' => array(// configurations per alert type
                'error' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
            ),
        ));
        ?>
    </div>
    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model, 'criteria_id', Criteria::model()->getSelectedCriteriaOptions()); ?>
    
    <?php echo $form->dropDownListRow($model, 'provider_a_id', Provider::model()->getProviders()); ?>

    <?php echo $form->dropDownListRow($model, 'provider_b_id', Provider::model()->getProviders()); ?>

    <?php echo $form->dropDownListRow($model, 'mark', ProviderCompare::model()->getMarkOptions()); ?>

<?php echo $form->textFieldRow($model, 'otherMark', array('labelOptions' => array('label' => false), 
   'placeholder' =>  Yii::t('app2', 'Or type a number here.') )); ?>


    <?php
    $model->comp = 1;
    echo $form->radioButtonListRow($model, 'comp', array(
    Yii::t('app2', 'Provider B is better then A'),    
    Yii::t('app2', 'Provider A is better then B') ,
    
    ));
    ?>


    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => Yii::t('app2', 'Compare'),
        ));
        ?>
    </div>
    <?php
    Yii::app()->clientScript->registerScript(
            'myHideEffect', '$(".flash-success").animate({opacity: 1.0}, 1500).fadeOut("slow");', 
            CClientScript::POS_READY
    );
    ?>
    <div class="flash-success">
        <?php
        $this->widget('bootstrap.widgets.TbAlert', array(
            'block' => true, // display a larger alert block?
            'fade' => true, // use transitions?
            'closeText' => '×', // close link text - if set to false, no close link is displayed
            'alerts' => array(// configurations per alert type
                'success' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
            ),
        ));
        $cpo = ProviderCompare::model()->getComparaisonRate();
        $report = ProviderCompare::model()->getRestedComparaisonReport();
        ?>
    </div>
    <small><span class="badge"><?php echo Yii::t('app2', 'you have compare').' ' .$cpo
        . ' % '.Yii::t('app2', 'of possible comparaison still') .' </span><br><b>' . $report . '</b>';
        ?></small>
        <?php 
        $this->widget('bootstrap.widgets.TbProgress', array(
            'percent' => $cpo, // the progress
            'striped' => true,
            'animated' => true,
            'type' => 'success',
            'content' => '<larg style="color:#000;">' . $cpo . ' %</larg>',
            'htmlOptions' => array('class' => 'custom'),
        ));
        $this->endWidget();
        ?>

</div><!-- form -->