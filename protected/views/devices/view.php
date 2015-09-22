<?php
$this->breadcrumbs=array(
	'Devices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Devices','url'=>array('index')),
	array('label'=>'Create Devices','url'=>array('create')),
	array('label'=>'Update Devices','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Devices','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Devices','url'=>array('admin')),
);
?>

<h1>View Devices #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_unit',
		'id_manufacture',
		'id_model',
		'id_user',
		'id_department',
		'id_place',
		'sn',
		'ip',
		'description',
	),
)); ?>
