<h1><?php echo Yii::t('app', 'Open a project');?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'appel-offre-form',
	'enableAjaxValidation'=>false,
         'htmlOptions'=>array('class'=>'well'),'type' => 'horizontal',
     'method'=>'GET',
)); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'id',  AppelOffre::model()->getAppelOffreOptions()); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>  Yii::t('app', 'Open'),
		)); ?>
</div>

<?php $this->endWidget(); 
$this->widget('bootstrap.widgets.TbAlert', array(
    'block' => true, // display a larger alert block?
    'fade' => true, // use transitions?
    'closeText' => '×', // close link text - if set to false, no close link is displayed
    'alerts' => array(// configurations per alert type
        'success' => array('block' => true, 'fade' => true, 'closeText' => '×'), // success, info, warning, error or danger
    ),
));
?>
