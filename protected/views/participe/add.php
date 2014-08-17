<h1><?php echo Yii::t('app1', 'Define Providers participated to this project'); ?></h1>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'criteria-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'), 'type' => 'horizontal',
        ));
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '×', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'error' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
    ),
));
?>

<?php echo '<p class="help-block">' . Yii::t('app', 'Fields with') . ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '.</p><br>';
?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'provider_id',
  CHtml::listData(Provider::model()->findAll(), 'id', 'id')); ?>

<?php echo $form->textFieldRow($model, 'finance', array('class' => 'span5', 'maxlength' => 32)); ?>	



<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => Yii::t('app', 'Add'),
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
    $this->endWidget();
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block' => true, // display a larger alert block?
        'fade' => true, // use transitions?
        'closeText' => '×', // close link text - if set to false, no close link is displayed
        'alerts' => array(// configurations per alert type
            'success' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
        ),
    ));
    ?>