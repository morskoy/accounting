<?php
$this->breadcrumbs=array(
	'Пароли'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'List Pass','url'=>array('index')),
	array('label'=>'Create Pass','url'=>array('create')),
	array('label'=>'View Pass','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Pass','url'=>array('admin')),
);
?>

<h1>Изменить пароль</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>