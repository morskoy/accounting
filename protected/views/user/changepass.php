<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Пользователи'=>array('index'),
    $model->last_name=>array('view','id'=>$model->id),
    'Изменить пароль',
);

$this->menu=array(
    array('label'=>'Пользователи', 'url'=>array('index')),
    array('label'=>'Создать', 'url'=>array('create')),
    array('label'=>'Показать', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1>Изменить пароль <?php echo $model->last_name.' '.$model->name.' '.$model->middle_name; ?></h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'changepass-form',
    'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'newPassword'); ?>
        <?php echo $form->textField($model,'newPassword',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'newPassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'verifyPassword'); ?>
        <?php echo $form->textField($model,'verifyPassword',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($model,'verifyPassword'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>