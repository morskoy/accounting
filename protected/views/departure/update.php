<?php
$this->breadcrumbs=array(
	'Departures'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Departure','url'=>array('index')),
	array('label'=>'Create Departure','url'=>array('create')),
	array('label'=>'View Departure','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Departure','url'=>array('admin')),
);
?>

<h1>Update Departure <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>