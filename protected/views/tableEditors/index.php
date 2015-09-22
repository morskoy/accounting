<?php
$this->breadcrumbs=array(
	'Table Editors',
);

$this->menu=array(
array('label'=>'Create TableEditors','url'=>array('create')),
array('label'=>'Manage TableEditors','url'=>array('admin')),
);
?>

<h1>Table Editors</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
