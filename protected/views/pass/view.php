<?php
$this->breadcrumbs=array(
	'Passes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pass','url'=>array('index')),
	array('label'=>'Create Pass','url'=>array('create')),
	array('label'=>'Update Pass','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Pass','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pass','url'=>array('admin')),
);
?>

<h1>View Pass #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_user',
		'id_programm',
		'login',
		'pass',
		'description',
	),
)); ?>
