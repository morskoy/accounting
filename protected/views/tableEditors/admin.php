<?php
$this->breadcrumbs=array(
	'Table Editors'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List TableEditors','url'=>array('index')),
array('label'=>'Create TableEditors','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('table-editors-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Table Editors</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'table-editors-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'user_id',
        array(
            'name' =>'editor_id',
            'value' => '$data->user->ShortFio',
            'sortable'=>false,
            //'htmlOptions'=>array('style'=>'text-align:left;'),
            //'headerHtmlOptions'=>array('style'=>'text-align:center;width:30px;padding:0;'),
        ),
		'date_start',
		//'date_finish',
		//'editor_id',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
