<?php
/* @var $this HelpdeskController */
/* @var $model Helpdesk */

$this->breadcrumbs=array(
	'Helpdesks'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>'Создать', 'url'=>array('createadm')),
	array('label'=>'Список', 'url'=>array('indexadm')),
	array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить задачу?')),
	//array('label'=>'Manage Helpdesk', 'url'=>array('admin')),
);
?>

<h1>View Helpdesk #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
            'name' => 'id_user',
            'value' => $model->user->FullFio,
        ),
		array(
            'name' => 'id_problem',
            'value' => $model->problem->problem,
        ),
		array(
            'name' => 'id_status',
            'value' => $model->status->status,
        ),
		'start_time',
		'finish_time',
		'hidden',
	),
)); ?>
