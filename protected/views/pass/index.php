<?php
$this->breadcrumbs=array(
	'Passes',
);

$this->menu=array(
	array('label'=>'Create Pass','url'=>array('create')),
	array('label'=>'Manage Pass','url'=>array('admin')),
);
?>

<h1>Passes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
