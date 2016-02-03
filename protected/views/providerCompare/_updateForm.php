
<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'provider-compare-_form-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'well'), 'type' => 'horizontal',
    ));
    echo '<p class="help-block">' . Yii::t('app', 'Fields with') . ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '.</p><br>' ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model, 'mark', ProviderCompare::model()->getMarkOptions());?>

    <?php echo $form->textFieldRow($model, 'otherMark', array('labelOptions' => array('label' => false), 
        'placeholder' => 'Or type a number here.')); ?>


    <?php
    echo $form->radioButtonListRow($model, 'comp', array(
        $model->provider_b_id .' '. Yii::t('app3', 'is better then').' ' . $model->provider_a_id,
        $model->provider_a_id .' '. Yii::t('app3', 'is better then').' ' . $model->provider_b_id,
    ));
    ?>


    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' =>  Yii::t('app2', 'Update') ,
        ));
        ?>
    </div>
    <?php
    Yii::app()->clientScript->registerScript(
            'myHideEffect', '$(".flash-success").animate({opacity: 1.0}, 1500).fadeOut("slow");', CClientScript::POS_READY
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
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->