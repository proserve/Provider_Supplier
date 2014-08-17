

<h1>Manage User Logs</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-log-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'username',
        'ipaddress',
        'logtime',
        'controller',
        'action',
        'details', 
    ),
));

?>
