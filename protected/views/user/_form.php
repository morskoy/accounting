<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form TbActiveForm */



$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'user-form',
'type'=>'horizontal',
'enableAjaxValidation'=>false,
)); ?>


<fieldset>

    <legend></legend>

	<p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php if(!$model->isNewRecord):?>
        <?php echo $form->textFieldRow($model, 'login'); ?>
    <?php endif; ?>
    <?php if($model->isNewRecord):?>
        <?php echo $form->textFieldRow($model, 'password'); ?>
    <?php endif; ?>
     <?php echo $form->textFieldRow($model, 'last_name'); ?>
    <?php echo $form->textFieldRow($model, 'name'); ?>
    <?php echo $form->textFieldRow($model, 'middle_name'); ?>
    <?php echo $form->dropDownListRow($model, 'gender', $model->Gender); ?>
    <?php echo $form->datePickerRow($model, 'birthday',array(
        'prepend'=>'<i class="icon-calendar"></i>',
        'value' => $model->birthday,
        'options' => array(
            'language' => 'ru',
            'format' => 'dd.mm.yyyy',
        ),
    )); ?>
    <?php echo $form->dropDownListRow($model, 'education', $model->Education); ?>

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

    <?php echo $form->dropDownListRow($model, 'mode', $model->Mode); ?>
    <?php echo $form->checkBoxRow($model, 'edit_table'); ?>
    <?php echo $form->checkBoxRow($model, 'sovmestitel'); ?>
    <?php echo $form->checkBoxRow($model, 'invalid'); ?>
    <?php echo $form->dropDownListRow($model, 'who_table',  CHtml::listData(User::model()->findAll(array('condition'=>'edit_table=1', 'order' => 'last_name ASC')),'id','last_name')); ?>


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
    <?php echo $form->textFieldRow($model, 'email'); ?>
    <?php echo $form->textFieldRow($model, 'tel_int'); ?>
    <?php echo $form->textFieldRow($model, 'tel_mobile'); ?>
    <?php echo $form->dropDownListRow($model, 'active', $model->userStatus); ?>
    <?php if(Yii::app()->user->checkAccess('administrator')):?>
        <?php echo $form->dropDownListRow($model, 'role',  CHtml::listData(UserRole::model()->findAll(),'role','role_rus')); ?>
    <?php endif; ?>

</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
</div>

<?php $this->endWidget(); ?>