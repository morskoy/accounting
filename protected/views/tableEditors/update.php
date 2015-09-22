<?php
$this->breadcrumbs=array(
	'Table Editors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List TableEditors','url'=>array('index')),
	array('label'=>'Create TableEditors','url'=>array('create')),
	array('label'=>'View TableEditors','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TableEditors','url'=>array('admin')),
	);
	?>

	<h1>Update TableEditors <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>