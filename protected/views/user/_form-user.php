<?php echo $form->textFieldRow($model, 'last_name'); ?>
<?php echo $form->textFieldRow($model, 'name'); ?>
<?php echo $form->textFieldRow($model, 'middle_name'); ?>
<?php echo $form->datePickerRow($model, 'birthday',array(
    'prepend'=>'<i class="icon-calendar"></i>',
    'value' => $model->birthday,
    'options' => array(
        'language' => 'ru',
        'format' => 'dd.mm.yyyy',
    ),
)); ?>
<div class="control-group ">
    <label class="control-label required" for="User_id_post">Должность <span class="required">*</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
    $this->widget('bootstrap.widgets.TbSelect2', array(
            'asDropDownList' => true,
            'name'           => 'User[id_post]',
            'data'           => Chtml::listData(Department::model()->AllDepartment,'id','department'),
            'val'           =>($model->isNewRecord ? '' : $model->id_post),
            'options'        => array(
                'allowClear' => true,
                'width' => '50%',
            ),
        )
    );
    ?>
</div>
<?php echo $form->dropDownListRow($model, 'gender', $model->Gender); ?>
<?php echo $form->dropDownListRow($model, 'education', $model->Education); ?>
<?php echo $form->textFieldRow($model, 'ident_code'); ?>
<?php echo $form->textFieldRow($model, 'passport'); ?>
<?php echo $form->textFieldRow($model, 'passport_vidan',array('class'=>'span5')); ?>
<?php echo $form->datePickerRow($model, 'passport_date',array(
    'prepend'=>'<i class="icon-calendar"></i>',
    'value' => $model->passport_date,
    'options' => array(
        'language' => 'ru',
        'format' => 'dd.mm.yyyy',
    ),
)); ?>

