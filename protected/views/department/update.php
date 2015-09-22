<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->department=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Редактировать отдел или должность</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>