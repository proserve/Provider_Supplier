<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'provider-compare-_form-form',

        'enableAjaxValidation' => true,
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

    <?php echo $form->dropDownListRow($model, 'id', AppelOffre::model()->getAllReadyAppelOffre()); ?>


    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => Yii::t('app2', 'Publish'),
        ));
        ?>
    </div>
    <?php
    Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
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
        $this->endWidget(); ?>

    </div>