<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'criteria-form',
	'enableAjaxValidation'=>true,
     'htmlOptions'=>array('class'=>'well'),'type' => 'horizontal',
)); 
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '×', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'success' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
    ),
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

<?php echo '<p class="help-block">'.Yii::t('app', 'Fields with').' <span class="required">*</span> '.Yii::t('app', 'are required').'.</p><br>'?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->errorSummary($categorie); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>256)); ?>

        <?php echo $form->dropDownListRow($categorie,'categorie_id', Categorie::model()->getCategorieOptions(),
                array( 'multiple'=>TRUE,
                    'style' =>'height: 100px',
            )); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>
</div>

<?php

$this->endWidget(); ?>