<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->last_name,
);
?>

<h1>Пользователь <?php echo $model->last_name.' '.$model->name.' '.$model->middle_name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'login',
        array('name' => 'ФИО', 'value' => $model->FullFio),
        array('name' => 'Пол', 'value' => $model->gender == 1 ? 'Мужской' : 'Женский'),
        'birthday',
        array('name' => 'education', 'value' =>  function($model) {
                if ($model->education == 1) return 'Среднее';
                elseif ($model->education == 2) return 'Профессионально-техническое';
                elseif ($model->education == 3) return 'Неоконченное высшее';
                else return 'Полное высшее';
        }),
        array('name' => 'id_post', 'value' => $model->post->department),
        'tbl_number',
        array('name' => 'hired_date_start', 'value' => $model->dateHired->date_start),
        array('name' => 'fired_date_start', 'value' => $model->dateFired->date_start),
        array('name' => 'editor_table', 'value' => $model->editor_table == 1 ? 'Да' : 'Нет'),
        array('name' => 'mode', 'value' => $model->mode == 1 ? 'Сменный' : 'Дневной'),
        array('name' => 'sovmestitel', 'value' => $model->sovmestitel == 1 ? 'Да' : 'Нет'),
        array('name' => 'invalid', 'value' => $model->invalid == 1 ? 'Да' : 'Нет'),
        'ident_code',
        'passport',
        'passport_vidan',
        'passport_date',
        'email',
        'tel_int',
        'tel_mobile',
        array('name' => 'Статус', 'value' => $model->active == 1 ? 'Включён' : 'Выключен'),
        array('name' => 'role', 'value' => $model->rights->role_rus)
    ),
)); ?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url'=>array('/user/index'),'type'=>'primary', 'label'=>'К списку')); ?>
</div>