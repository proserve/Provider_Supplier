<?php echo '<h1>'.Yii::t('app2', 'Update project technical & finance rates').'</h1>';

 $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'appel-offre-form',
	'enableAjaxValidation'=>false,
         'htmlOptions'=>array('class'=>'well ,pull-right'),'type' => 'horizontal',
   // 'htmlOptions'=>array('class'=>'pull-right'),
)); 

$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '×', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'error' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
    ),
));
 echo '<p class="help-block">'.Yii::t('app', 'Fields with').' <span class="required">*</span> '.Yii::t('app', 'are required').'.</p><br>';
echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'technique_rate',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'finance_rate',array('class'=>'span5')); ?>






<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=> Yii::t('app2', 'Update'),
		)); ?>
</div>

<?php $this->endWidget();

?>
