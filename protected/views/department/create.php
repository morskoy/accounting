<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	'Create',
);
?>

<h1>Создать отдел или должность</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>