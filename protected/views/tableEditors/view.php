<?php
    $this->widget( 'ext.EUpdateDialog.EUpdateDialog', array(
        'dialogOptions'=>array(
            'width'=>'650',
            'height'=>'450',
            'resizable' => true,

        ),
    ));
?>
<?php
$this->breadcrumbs=array(
	'Редакторы табеля'=>array('index'),

);
/**
$this->menu=array(
array('label'=>'List TableEditors','url'=>array('index')),
array('label'=>'Create TableEditors','url'=>array('create')),
array('label'=>'Update TableEditors','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete TableEditors','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TableEditors','url'=>array('admin')),
);
 */
//var_dump($model);
//exit;
?>

<h1><?php echo $userName; ?></h1>
<br>

<?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Добавить редактора табеля',
        'type'=>'action', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'large', // null, 'large', 'small' or 'mini'
        'url' => $this->createUrl('tableEditors/create', array('userId'=>$userId)),
        'htmlOptions' => array(
            'class' => 'update-dialog-open-link',
            'data-update-dialog-title' => 'Добавить редактора табеля',
        ),
    ));


    $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'table-editors-grid',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}{pager}",
    'columns'=>array(
        array(
            'name' =>'editor_id',
            'value' => '$data->editor->ShortFio',
            'sortable'=>false,
            //'htmlOptions'=>array('style'=>'text-align:left;'),
            //'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
        ),
        array(
            'name' => 'date_start',
            'sortable' => false,
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
            'buttons' => array(
                'update' => array(
                    'click' => 'updateDialogOpen',
                    'options' => array(
                        'data-update-dialog-title' => 'Изменить редактора табеля',
                    ),
                ),
                'delete' => array(
                    'click' => 'updateDialogOpen',
                    'url' => 'Yii::app()->createUrl(
                            "/tableEditors/delete",
                            array( "id" => $data->id ) )',
                    'options' => array(
                        'data-update-dialog-title' => 'Удаление редактора',
                    ),
                ),

                ),
            )
        ),
    )
); ?>
