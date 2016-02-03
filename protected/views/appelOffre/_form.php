<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'appel-offre-form',
    'enableAjaxValidation' => true,
    'htmlOptions' => array('class' => 'well ,pull-right'), 'type' => 'horizontal',
    'enableClientValidation' => true,
    // 'htmlOptions'=>array('class'=>'pull-right'),
)); ?>



<?php echo '<p class="help-block">' . Yii::t('app', 'Fields with') . ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '.</p><br>';
echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'reference', array('class' => 'span5', 'maxlength' => 256)); ?>

<?php echo $form->textFieldRow($model, 'number', array('class' => 'span5')); ?>

<?php echo $form->textFieldRow($model, 'titre', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'type', array('class' => 'span5', 'maxlength' => 512)); ?>

<?php echo $form->datepickerRow($model, 'dateDebut', array('prepend' => '<i class="icon-calendar"></i>', 'options' => array('format' => 'yyyy-mm-dd'))); ?>

<?php echo $form->datepickerRow($model, 'dateFin', array('prepend' => '<i class="icon-calendar"></i>', 'options' => array('format' => 'yyyy-mm-dd'),)); ?>

<?php echo $form->textAreaRow($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

<?php echo $form->textAreaRow($model, 'condition', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

<?php if (!$model->isNewRecord)
    echo $form->textFieldRow($model, 'publish', array('class' => 'span4'));
?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
    )); ?>
</div>

<?php $this->endWidget();
?>

