<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'provider-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'well'),'type' => 'horizontal',
    'method' => 'Post'
)); ?>

<?php echo '<p class="help-block">' . Yii::t('app', 'Fields with') . ' <span class="required">*</span> ' . Yii::t('app', 'are required') . '.</p><br>' ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>512)); ?>

	<?php echo $form->textFieldRow($model,'postal_address',array('class'=>'span5','maxlength'=>256)); ?>
	
	<?php echo $form->textFieldRow($model,'post_code',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>
	
	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>255)); ?>
	

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'),
		)); ?>
</div>

<?php $this->endWidget(); ?>
