<?php if($model->isNewRecord):?>
<?php echo $form->datePickerRow($model, 'hired_date_start', array(
    'prepend'=>'<i class="icon-calendar"></i>',
    'value' => $model->hired_date_start,
    'options' => array(
        'language' => 'ru',
        'format' => 'dd.mm.yyyy',
    ),
)); ?>
<?php echo $form->dropDownListRow($model, 'editor',  CHtml::listData(User::model()->findAll(array('condition'=>'editor_table=1', 'order' => 'last_name ASC')),'id','last_name')); ?>
<?php endif; ?>
<?php echo $form->textFieldRow($model, 'tbl_number'); ?>
<?php echo $form->checkBoxRow($model, 'editor_table'); ?>
<?php echo $form->dropDownListRow($model, 'mode', $model->Mode); ?>
<?php echo $form->checkBoxRow($model, 'sovmestitel'); ?>
<?php echo $form->checkBoxRow($model, 'invalid'); ?>
<?php echo $form->datePickerRow($model, 'fired_date_start', array(
    'prepend'=>'<i class="icon-calendar"></i>',
    'value' => $model->fired_date_start,
    'options' => array(
        'language' => 'ru',
        'format' => 'dd.mm.yyyy',
    ),
)); ?>

