<?php echo '<h1>'.Yii::t('app', 'Create new project').'</h1>';

echo $this->renderPartial('_form', array('model'=>$model)); ?>