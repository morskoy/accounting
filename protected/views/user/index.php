<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Пользователи',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Пользователи</h1>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Создать пользователя',
    'type'=>'action', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
    'url' => $this->createUrl('user/create'),
));


$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id'=>'user-grid',
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
    'filter' => $model,
    'template'=>"{items}{summary}{pager}",
    'columns'=>array(
        'last_name',
        'name',
        'middle_name',
        array(
            'name' => 'login',
            'visible'=>'Yii::app()->user->checkAccess("administrator")',
        ),
        array(
            'name' => 'post_post',
            'value' => '$data->post->department',
        ),
        'tel_int',
        'tel_mobile',
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px;text-align:center;'),
            'template'=>'{view}{update}{password}{disable}{enable}{editor}{delete}',
            'buttons' => array(
                'password' => array(
                    'label'=>'Пароли пользователя',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/pass.png',
                    'url'=>'Yii::app()->createUrl("pass/admin", array("user_id"=>$data->id))',
                    'visible'=>'Yii::app()->user->checkAccess("administrator")',
                ),
                'disable' => array(
                    'label'=>'Отключить пользователя',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/disable.png',
                    'url'=>'Yii::app()->createUrl("user/disable", array("id"=>$data->id))',
                    'visible'=>'Yii::app()->user->checkAccess("administrator") && $data->active == 1',
                    'click'=>'function(){return confirm("Вы действительно хотите отключить пользователя?");}'
                ),
                'enable' => array(
                    'label'=>'Включить пользователя',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/enable.png',
                    'url'=>'Yii::app()->createUrl("user/enable", array("id"=>$data->id))',
                    'visible'=>'Yii::app()->user->checkAccess("administrator") && $data->active == 0',
                    'click'=>'function(){return confirm("Включить пользователя?");}'
                ),
                'editor' => array(
                    'label'=>'Изменить редактора табеля',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/change_editor.png',
                    'url'=>'Yii::app()->createUrl("tableEditors/view", array("userId"=>$data->id))',
                    'visible'=>'Yii::app()->user->checkAccess("editor")',
                ),

                'delete' => array(
                    'label'=>'Удалить',
                    'visible'=>'Yii::app()->user->checkAccess("administrator")',
                    'click'=>'function(){return confirm("Вы действительно хотите отключить пользователя?");}'
                ),

            )
        ),
    ),
));
?>