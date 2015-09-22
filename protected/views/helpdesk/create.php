<?php
/* @var $this HelpdeskController */
/* @var $model Helpdesk */

$this->breadcrumbs=array(
	'Helpdesks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Создать задачу</h1>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'helpdesk-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

  <div class="row">
        <?php echo $form->labelEx($model,'id_problem'); ?>
        <?php echo $form->dropDownList($model,'id_problem',
            CHtml::listData(HdProblem::model()->findAll(),'id','problem')
        ); ?>
        <?php echo $form->error($model,'id_problem'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description', array('maxlength'=>199, 'cols'=>50, 'rows'=>6, )); ?>
        <?php echo $form->error($model,'description'); ?>
    </div>

   <div class="row buttons">
        <?php echo CHtml::submitButton('Создать'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->