<?php
$this->breadcrumbs=array(
	'Выезды'=>array('index'),
	'Администрирование',
);
?>

<h1>Администрирование выездов</h1>
<br>

<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'size' => 'large',
    'type'=>'info',
    'buttons'=>array(
        array('label'=>'Список заявок','url'=>array('admin')),
        array('label'=>'Создать заявку','url'=>array('create'))
    ),
));

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'departure-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
    'type'=>'striped bordered condensed',
	'columns'=>array(
        array(
            'name' => '№',
            'value' => function($data, $row, $column) {
                /** @var $grid CGridView */
                $grid = $column->grid;
                /** @var $pages CPagination */
                $pages = $grid->dataProvider->getPagination();

                $start = ($grid->enablePagination === false)
                    ? 0
                    : $pages->getCurrentPage(false) * $pages->getPageSize();

                return $start + $row + 1;
            },
        ),
        array(
            'name' => 'id_user',
            'value' => '$data->user->ShortFio',
        ),
        array(
            'name'=>'id_post',
            'value'=>'$data->post->department',
        ),
        array(
            'name' => 'id_place',
            'value' => '$data->place->place',
        ),
        'description',
        array(
            'name' => 'order',
            'value' => '$data->user_order->ShortFio',
        ),
        'date_departure',
        'date_arrival',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
