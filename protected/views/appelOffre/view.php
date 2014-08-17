<?php echo '<h1>'.Yii::t('app1', 'View Project: ')  . $model->titre . '</h1>'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'reference',
		'number',
		'titre',
		'dateDebut',
		'dateFin',
		'description',
		'condition',
),
)); ?>
