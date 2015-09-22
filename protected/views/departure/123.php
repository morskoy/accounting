<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>"vendorGrid",
    'type'=>'striped bordered condensed',
    'dataProvider'=>$model->search(),
    'template'=>"{items} {summary} {pager}",
    'filter' => $model,
    'columns'=>array(
        array('name'=>'name'),
        array('name'=>'active'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'white-space: nowrap;','class'=>"span1"),
            'template' => '{edit} {add_model}',
            'buttons'  =>array(
                'add_model'=>array(
                    'label'=>'<img src="/img/car1.png" style="height:14px;">',
                    'encodeLabel'=>false,
                    'type'=>'btn',
                    'url'=>'Yii::app()->createUrl("/crm/vendor/", array("id" => $data->id))',
                    'options'=>array(
                        'title'=>'Добавление модели',
                        'class'=>'btn',
                        'data-toggle'=>'modal',
                        'data-target'=>'#models',
                    ),
                ),
                'edit'=>array('label'=>'<i class="icon-edit"></i>','encodeLabel'=>false,'type'=>'btn','options'=>array('class'=>'btn','data-toggle'=>'modal',
                    'data-target'=>'#edit',))
            )
        ),
    ),
));
?>
</div>