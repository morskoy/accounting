<?php
$this->breadcrumbs=array(
	'Devices'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Devices','url'=>array('index')),
	array('label'=>'Create Devices','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('devices-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Devices</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView',array(
	'id'=>'devices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name' => 'id_unit',
            'value' => '$data->unit->unit',
            'filter' => CHtml::listData(Units::model()->findAll(), 'id', 'unit'),
        ),
        array(
            'name' =>  'id_manufacture',
            'value' => '$data->manufacture->manufacture',
            'filter' => CHtml::listData(Manufactures::model()->findAll(), 'id', 'manufacture'),
        ),
        array(
            'name' => 'id_model',
            'value' => '$data->model->model',
            'filter' => CHtml::listData(Models::model()->findAll(), 'id', 'model'),
        ),

		//'id_user',
		//'id_department',
		//'id_place',
		//'sn',
		'ip',
        'mask',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
