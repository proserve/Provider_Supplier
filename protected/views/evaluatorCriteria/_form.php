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

<?php echo '<p class="help-block">' . Yii::t('app', 'Fields with') . ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '.</p><br>' ?>

<?php echo $form->errorSummary($model); ?>
    <?php echo $form->dropDownListRow($model, 'criteria_id', Criteria::model()->getCriteriasListForEvaluator()); ?>
<?php echo $form->dropDownListRow($model, 'mark', EvaluatorCriteria::model()->getMarkOptions());
?>

<?php echo $form->textFieldRow($model, 'otherMark', array('labelOptions' => array('label' => false),
    'placeholder' =>  Yii::t('app2', 'Or type a number here.') ));
?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('app2', 'Evaluate') : Yii::t('app', 'Save'),
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
    $array = array();
    foreach (Criteria::model()->getCriteriasNotEvaluatedByUsername() as $key => $value) {
        $array[$key] = $value['name'];
    }
    if (count($array) == 0) {
        $array[0] = Yii::t('app2', 'Nothing, your done');
    }


    $cou = count(Criteria::model()->getCriteriasListForEvaluator());
    $cou1 = Criteria::model()->getCountEvaluatedCriterias(Yii::app()->user->name);
    if ($cou == 0) {
        $vi = 0;
    } else {
        $vi = round((100 / $cou) * $cou1, 2);
    }
    ?>
</div>

<!--
<span class="label label-important"><?php
   // echo Yii::t('app1', 'you have evaluate') . ' ' . $vi
   // . '% ' . Yii::t('app2', 'of criterias, still') . ' <b>( ' . implode(',', $array) . ')</b></br>';
   // ?></span> 
<br>-->
<?php $this->endWidget();
?>

<?php
$this->widget('bootstrap.widgets.TbProgress', array(
    'percent' => $vi, // the progress
    'striped' => true,
    'animated' => true,
    'content' => $vi,
));
?>