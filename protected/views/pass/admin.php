<?php
$this->breadcrumbs=array(
	'Пароли'=>array('index'),
	'Менеджер',
);

$this->menu=array(
	array('label'=>'List Pass','url'=>array('index')),
	array('label'=>'Create Pass','url'=>array('create')),
);


?>

<h1>Manage Passes</h1>





<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'pass-grid',
    'type'=>'striped bordered condensed',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns' => array(
         array(
            'name' => 'id_user',
            'value' => '$data->user->ShortFio',
        ),
		array(
            'name' => 'id_programm',
            'value' => '$data->programm->programm',
        ),
		'login',
		'pass',
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
