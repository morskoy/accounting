<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Создать',
);

?>

<h1>Создать пользователя</h1>

<p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'user-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
));
?>

<?php
$this->widget('bootstrap.widgets.TbTabs', array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'placement'=>'top',
        'tabs' => array(
            array(
                'label'=>'Общие данные',
                'content'=>$this->renderPartial('_form-user', array('model'=>$model,'form'=>$form), true),
                'active'=>true,

            ),
            array(
                'label'=>'Табель',
                'content'=>$this->renderPartial('_form-table', array('model'=>$model,'form'=>$form), true),
            ),
            array(
                'label' => 'Администрирование',
                'content' => $this->renderPartial('_form-admin', array('model'=>$model,'form'=>$form), true),
                'visible' => Yii::app()->user->checkAccess('administrator'),
            ),
        ),
    )
);
?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url'=>array('/user/index'),'type'=>'danger', 'label'=>'Отмена')); ?>
</div>

<?php $this->endWidget(); ?>

