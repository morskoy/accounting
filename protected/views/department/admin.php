<?php
/* @var $this DepartmentController */
/* @var $model Department */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	'Manage',
);
?>

<h1>Отделы и должности</h1>



<?php $this->widget('ext.QTreeGridView.CQTreeGridView', array(
    'ajaxUpdate' => false,
    'id'=>'department-grid',
	'dataProvider'=>$model->search(),
    //'enablePagination' => false,
	//'filter'=>$model,

	'columns'=>array(
		'department',
		array(
			'class'=>'CButtonColumn',
            'template'=>'{create}{update}',
            'buttons' => array(
                'create' => array(
                    'label'=>'Создать',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/create.png',
                    'url'=>'Yii::app()->createUrl("department/create", array("department_id"=>$data->id))',
                )
            )
		),
	),
)); ?>
