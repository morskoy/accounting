<?php
$this->breadcrumbs=array(
	'Выезд'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	//array('label'=>'Manage Departure','url'=>array('admin')),
);
?>

<h1>Сопроводительная записка к маршруту</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>