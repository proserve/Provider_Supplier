
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'criteria-form',
    'enableAjaxValidation' => true,
    'htmlOptions'=>array('class'=>'well'),'type' => 'horizontal',
    
        ));
?>

<?php echo '<p class="help-block">'.Yii::t('app', 'Fields with').' <span class="required">*</span> '.Yii::t('app', 'are required').'.</p><br>'?>

<?php echo $form->errorSummary($model); ?>
    <?php echo $form->dropDownListRow($model, 'mark', EvaluatorCriteria::model()->getMarkOptions());
           
    ?>
   
 <?php echo $form->textFieldRow($model,'otherMark',array( 'labelOptions' => array('label' => false), 
     'placeholder' =>  Yii::t('app2', 'Or type a number here.') )); ?>



<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
    ));
    ?>
    
</div>
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
  </div>
<?php $this->endWidget(); ?>

 