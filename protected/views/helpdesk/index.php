<?php
/* @var $this HelpdeskController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'HelpDesk',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Helpdesks</h1>

<?php
    echo "<img src='".Yii::app()->baseUrl."/images/hd_status_1.png' alt='Ожидает рассмотрения'> - Ожидает рассмотрения,
             <img src='".Yii::app()->baseUrl."/images/hd_status_4.png' alt='В работе'> - В работе,
             <img src='".Yii::app()->baseUrl."/images/hd_status_7.png' alt='Выполнена'> - Выполнена.";
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'helpdesk-grid',
    'dataProvider'=>$dataProvider->model->search(),
    'columns'=>array(
        'start_time',
        'finish_time',
        array(
            'name' => 'id_problem',
            'value' => '$data->problem->problem',
        ),
        array(
            'name' => 'id_status',
            'type'=>'raw',
            'value' => function($data){
                if ($data->id_status == 1) return Chtml::image(Yii::app()->baseUrl.'/images/hd_status_1.png','Ожидает рассмотрения');
                elseif ($data->id_status == 4) return Chtml::image(Yii::app()->baseUrl.'/images/hd_status_4.png','В работе');
                else return Chtml::image(Yii::app()->baseUrl.'/images/hd_status_7.png','Выполнена');
            },
            'htmlOptions'=>array('style'=>'text-align: center; '),
        ),
    ),
));


/*
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'start_time', 'header'=>'Дата'),
        array('name'=>'$data->problem->problem', 'header'=>'Проблема'),
        array('name'=>'id_status', 'header'=>'Статус'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
            'htmlOptions'=>array('style'=>'width: 20px'),
        ),
    ),
));
*/
?>
