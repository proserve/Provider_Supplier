<?php echo '<h1>'.Yii::t('app1', 'Manage Categories'). '</h1>' ?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'categorie-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'name',
		'description',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
