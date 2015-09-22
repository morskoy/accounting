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
	'columns'=>array(
		array(
            'name' => 'last_name',
            'header'=>'Имя',
            'value' => '$data->FullFio',
		),
		array(
            'name' => 'id_post',
            'value' => '$data->post->post',
        ),
		array(
			'name' => 'id_department',
            'value' => '$data->department->department." ".$data->sub_department->sub_department',
		),
		'email',
		'tel_int',
		'id_tel_mobile',
	),
)); 
?>