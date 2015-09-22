<?php

$this->pageTitle=Yii::app()->name . ' - Справочник';
$this->breadcrumbs=array(
    'Справочник',
);
?>

<h1>Справочник</h1>

<?php
$params = array(
    'pageSize'=>100,
    'condition'=>'tel_int',
);
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search($params),
    'filter' => $model,
    //'enablePagination'=>false,
    'template'=>"{items}",
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
        array(
            'name' => 'post_post',
            'value' => '$data->post->department',
        ),

        'email',
        'tel_int',
        array(
            'name' => 'tel_mobile',
            'value' => '$data->tel_mobile != 0 ? "(0".mb_substr($data->tel_mobile,0,2).") ".mb_substr($data->tel_mobile,2,3)."-".mb_substr($data->tel_mobile,5,2)."-".mb_substr($data->tel_mobile,7,2) :  ""',
            'htmlOptions'=>array('style'=>'width: 130px')
        ),
    ),
));
?>