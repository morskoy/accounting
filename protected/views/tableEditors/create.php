<?php
$this->breadcrumbs=array(
	'Table Editors'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TableEditors','url'=>array('index')),
array('label'=>'Manage TableEditors','url'=>array('admin')),
);
?>

<h1>Create TableEditors</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>