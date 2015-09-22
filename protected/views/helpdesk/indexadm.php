<?php

$this->breadcrumbs=array(
    'HelpDesk',
);

$this->menu=array(
    array('label'=>'Создать', 'url'=>array('createadm')),
);
?>

<h1>Helpdesks</h1>

<?php
    echo "<img src='".Yii::app()->baseUrl."/images/hd_status_1.png' alt='Ожидает рассмотрения'> - Ожидает рассмотрения,
         <img src='".Yii::app()->baseUrl."/images/hd_status_4.png' alt='В работе'> - В работе,
         <img src='".Yii::app()->baseUrl."/images/hd_status_7.png' alt='Выполнена'> - Выполнена.";
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'helpdesk-grid',
    'dataProvider'=>$model->search(),
    'columns'=>array(
        'start_time',
        'finish_time',
        array(
            'name' => 'id_user',
            'value' => '$data->user->ShortFio',
        ),
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
        array(
            'class' => 'CButtonColumn',
        )
    ),

));
?>