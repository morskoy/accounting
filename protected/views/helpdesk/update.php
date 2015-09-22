<?php
/* @var $this HelpdeskController */
/* @var $model Helpdesk */

$this->breadcrumbs=array(
	'Helpdesks'=>array('indexadm'),
	$model->id=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('createadm')),
    array('label'=>'Список', 'url'=>array('indexadm')),
);
?>

<h1>Редактировать Helpdesk</h1>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'helpdesk-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'id_user');
        echo $form->dropDownList($model, 'id_user',
            Chtml::listData(User::model()->findAll(),'id','ShortFio')
        );
        echo $form->error($model, 'id_user');
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model,'start_time');
        $this->widget('ext.jui.EJuiDateTimePicker', array(
            'model' => $model,
            'attribute' => 'start_time',
            'language' => 'ru',
            'options' => array(
                'dateFormat' => 'dd.mm.yy',
                'timeFormat' => 'hh:mm',
            )

        ));
        echo $form->error($model,'start_time');
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model,'finish_time');
        $this->widget('ext.jui.EJuiDateTimePicker', array(
            'model'=>$model,
            'attribute'=>'finish_time',
           'language'=>'ru',
            'options'=>array(
                'dateFormat'=>'dd.mm.yy',
                'timeFormat'=>'hh:mm'
            )
        ));
        echo $form->error($model,'finish_time');
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model, 'id_problem');
        echo $form->dropDownList($model,'id_problem',
            Chtml::listData(HdProblem::model()->findAll(),'id','problem')
        );
        echo $form->error($model,'id_problem');
        ?>
    </div>

    <div class="row">
        <?php
        echo $form->labelEx($model,'description');
        echo $form->textArea($model,'description',array(
            'maxlength'=>199,
            'cols'=>20,
            'rows'=>5,
        ));
        echo $form->error($model,'description');
        ?>
    </div>
    <div class="row">
        <?php
        echo $form->labelEx($model,'id_status');
        echo $form->dropDownList($model,'id_status',
            Chtml::listData(HdStatus::model()->findAll(),'id','status')
        );
        echo $form->error($model,'id_status');
        ?>
    </div>
    <div class="row">
        <?php
        //echo $form->labelEx($model,'hidden');
        //echo $form->checkBox($model,'hidden');
        //echo $form->error($model,'hidden');
        ?>
    </div>
    <div class="row buttons">
        <?php echo Chtml::submitButton('Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>