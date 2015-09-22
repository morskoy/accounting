<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'table-editors-form',
	//'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
)); ?>

<p class="help-block">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'editor_id',  CHtml::listData(User::model()->getAllShortFio(),'id','shortName'), array('class'=>'span3')); ?>

<?php echo $form->labelEx($model,'date_start'); ?>
<?php

$this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'TableEditors[date_start]',
    'model'=>$model,
    'value' => $model->isNewRecord ? '' : $model->date_start,
    'language'=>'ru',

    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'slide',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
        'dateFormat' => 'dd.mm.yy',

    ),
    'htmlOptions'=>array(
        //'style'=>'',
    ),
));

?>
<?php echo $form->error($model,'date_start'); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=> $model->isNewRecord ? 'Добавить' : 'Сохранить',
		)); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'link',
        'url'=>array('/tableEditors/view'),
        'type'=>'danger',
        'label'=>'Отмена',
        'htmlOptions' => array(
            'class'=>'update-dialog-cancel-button'
        )
    )); ?>

</div>

<?php $this->endWidget(); ?>
