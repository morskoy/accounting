<?php
$this->breadcrumbs=array(
	'Выезд',
);

//$this->menu=array(
//	array('label'=>'Создать','url'=>array('create')),
//	array('label'=>'Manage Departure','url'=>array('admin')),
//);
?>

<h1>Выезд</h1>
<?php
$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Создать заявку',
    'size' => 'large',
    'type'=>'info',
    'url'=>array('create'),
));

//$this->widget('bootstrap.widgets.TbListView',array(
	//'dataProvider'=>$dataProvider,
	//'itemView'=>'_view',
//));
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items} {summary} {pager}",
    'columns'=>array(
        array(
            'header' => '№',
            'value' => '$row+1'
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
        array(
            'name' => 'date_arrival',
            'type' => 'raw',
            'value' => function($data) {
                if ($data->date_arrival == '') {
                    echo CHtml::ajaxButton('Отметить',
                        array('departure/updateArrival'),
                        array(
                            'type'=>'POST',
                            'data'=>array(
                                'id'=>$data->id,
                            ),
                            'success'=>'function(data){
                                curBtn.remove();
                                parent.text(data);
                            }'
			            ),
                        array(
                            'onclick'=>'
                                curBtn = $(this);
                                parent = $(this).parent();
                            '
                        )
			
		);
                } else return $data->date_arrival;
            },
            'htmlOptions'=>array(
		'style'=>'text-align: center; vertical-align: middle;'
		
	),


        ),
      ),
));




?>
