<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>

<h1><?php echo Yii::t('app3', 'Connecte') ; ?></h1>


<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo '<p class="help-block">'.Yii::t('app', 'Fields with').' <span class="required">*</span> '.Yii::t('app', 'are required').'.</p><br>'?>

	<?php echo $form->textFieldRow($model,'username'); ?>

	<?php echo $form->passwordFieldRow($model,'password',array(
    )); ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=> Yii::t('app3', 'Login'),
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
