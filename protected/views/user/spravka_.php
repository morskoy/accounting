<?php

$this->pageTitle=Yii::app()->name . ' - Справочник';
$this->breadcrumbs=array(
    'Справочник',
);
?>

<h1>Справочник</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search(),
    'filter' => $model,
    'columns'=>array(
        array(
            'header' => '№',
            'value' => '$row+1'
        ),
        array(
            'name' => 'last_name',
            'header'=>'Имя',
            'value' => '$data->FullFio',
        ),
        //'post.post',
        array(
            'name'=>'post_post',
            'value'=>'$data->post->post',
            //'filter' => CHtml::activeTextField($model, 'dolgnost'),
            //'sortable'=>true,
        ),
        /**
        array(
            'name' => 'id_department',
            'value' => '$data->department->department." ".$data->sub_department->sub_department',
        ),
         */
        'email',
        'tel_int',
        array(
            'name' => 'id_tel_mobile',
            'value' => '$data->id_tel_mobile != 0 ? "(0".mb_substr($data->id_tel_mobile,0,2).") ".mb_substr($data->id_tel_mobile,2,3)."-".mb_substr($data->id_tel_mobile,5,2)."-".mb_substr($data->id_tel_mobile,7,2) :  ""',
        ),


    ),
));
?>