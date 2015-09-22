<?php
$this->breadcrumbs=array(
	'Пароли'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'List Pass','url'=>array('index')),
	array('label'=>'Manage Pass','url'=>array('admin')),
);
?>

<h1>Create Pass</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>