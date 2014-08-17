<?php echo '<h1>'.Yii::t('app1', 'View profile of evaluator: '). $model->username.'</h1>' ?>


<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
                'username',
		'fist_name',
		'last_name', 
                'function',
),
));

?>
