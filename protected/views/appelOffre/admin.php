 <?php echo '<h1>'.Yii::t('app1', 'Manage Projects: ')  . '</h1>'; ?>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'appel-offre-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'reference',
		'number',
		'titre',
                'type',
		'dateDebut',
		'dateFin',
		'technique_rate',
                'finance_rate',
                'publish',
		'description',
		'condition',
		
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
