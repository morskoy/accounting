<?php
$this->breadcrumbs=array(
    'Выезд',
);

//$this->menu=array(
//    array('label'=>'Создать','url'=>array('create')),
//);
?>

<h1>Выезд</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
    'template'=>"{items} {summary} {pager}",
    //'filter' => $model,
    'afterAjaxUpdate'=>"function() {
        jQuery('#Departure_date_departure').datepicker(jQuery.extend(jQuery.datepicker.regional['ru'],{'showAnim':'fold', 'dateFormat':'dd.mm.yy',
        'timeFormat':'hh:mm','showButtonPanel':'true',}));
    }",
    'columns'=>array(
        'nn' => array(
            'name' => 'nn',
            'header' => '№',
            'value' => function($data, $row, $column) {
                /** @var $grid CGridView */
                $grid = $column->grid;
                /** @var $pages CPagination */
                $pages = $grid->dataProvider->getPagination();

                $start = ($grid->enablePagination === false) ? 0 : $pages->getCurrentPage(false) * $pages->getPageSize();

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
        array(
            'name'=>'date_departure',
            'type'=>'raw',
            'filter'=>false,
            'filter'=>$this->widget('ext.jui.EJuiDateTimePicker', array(
                'model'=>$model,
                'attribute'=>'date_departure',
                'language'=>'ru',
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat' => 'dd.mm.yy',
                    'timeFormat' => 'hh:mm',
                    'showButtonPanel' => 'true',
                ),
            ),true),
            'htmlOptions' => array('style' => 'text-align: center; vertical-align: middle; width:115px;'),
        ),
        array(
            'name' => 'date_arrival',
            'value' => function($data){
                if($data->date_arrival == '') echo '<span class="label label-important">Не отмечено</span>';
                else echo $data->date_arrival;
            },
            'htmlOptions' => array('style'=>'text-align: center; vertical-align: middle; width:118px;'),
        )
    ),
));