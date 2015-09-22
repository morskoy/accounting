<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'departure-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $form->errorSummary($model); ?>

<?php
echo $form->dropDownListRow($model,'id_user', array( Yii::app()->user->id => Yii::app()->user->ShortName), array('class'=>'span4', 'disabled'=>false,));

echo $form->labelEx($model,'id_post');
echo Chtml::textField('post',Yii::app()->user->post, array('class'=>'span4', 'disabled'=>true,));
echo $form->hiddenField($model,'id_post',array('value'=>Yii::app()->user->id_post));
echo $form->error($model,'id_post');

echo $form->dropDownListRow($model,'id_place',
    Chtml::listData(DeparturePlace::model()->findAll(),'id','place'),
    array('rows'=>6, 'cols'=>50, 'class'=>'span4')
);
echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));

echo $form->dropDownListRow($model,'order',
    Chtml::listData(User::model()->findAll(
        array(
            'condition'=>'role = :role1 OR role = :role2',
            'order'=>'last_name',
            'params'=>array(
                ':role1'=>'director',
                ':role2'=>'chief'
            )
        )
    ), 'id', 'FullFio'),
    array('class'=>'span4'));

echo $form->labelEx($model,'date_departure');
$this->widget('ext.jui.EJuiDateTimePicker', array(
    'model' => $model,
    'attribute' => 'date_departure',
    //'value' =>
    'language' => 'ru',
    'htmlOptions' => array('class' => 'span4'),
    'options' => array(
        'dateFormat' => 'dd.mm.yy',
        'timeFormat' => 'hh:mm',
    )
));
echo $form->error($model,'date_departure');

if (!$model->isNewRecord) {
    echo $form->labelEx($model,'date_arrival');
    $this->widget('ext.jui.EJuiDateTimePicker', array(
        'model' => $model,
        'attribute' => 'date_arrival',
        'language' => 'ru',
        'options' => array(
            'dateFormat' => 'dd.mm.yy',
            'timeFormat' => 'hh:mm',
        )

    ));
    echo $form->error($model,'date_arrival');
}

?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
	)); ?>
</div>

<?php $this->endWidget(); ?>
