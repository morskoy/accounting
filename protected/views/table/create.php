<?php
$this->breadcrumbs=array(
	'Tables'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Table','url'=>array('index')),
array('label'=>'Manage Table','url'=>array('admin')),
);
?>

<h1>Create Table</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl('table/create'),
    'method'=>'post',
)); ?>

<?php echo $form->dropDownListRow($modelUser, 'who_table',  CHtml::listData(User::model()->findAll(array('condition'=>'edit_table=1', 'order' => 'last_name ASC')),'id','last_name')); ?>
<?php echo $form->datePickerRow($modelTable, 'date_completion',array(
    'prepend'=>'<i class="icon-calendar"></i>',
    'options' => array(
        'language' => 'ru',
        'format' => 'dd.mm.yyyy',
    ),
)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type'=>'primary',
        'label'=>'Создать',
    )); ?>
</div>

<?php $this->endWidget(); ?>