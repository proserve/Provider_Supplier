

<h1><?php echo Yii::t('app2', 'View Provider').  ' # '.$model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'postal_address',
		'post_code',
		'email',
		'phone',
),
)); ?>
