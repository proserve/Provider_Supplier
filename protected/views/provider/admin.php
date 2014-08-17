
<h1><?php echo Yii::t('app2', 'Create Provider') ; ?></h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'provider-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'name',
		'postal_address',
		'post_code',
		'email',
		'phone',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
