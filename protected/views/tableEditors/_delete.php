
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'table-editors-form',

));
/**
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'ajaxSubmit',
    'type'=>'danger',
    'label'=> 'Да',
    'ajaxOptions'=>array(
        //'name' => 'deleteConfirmed',
        //'value' => 'true',
        'type' => 'POST',
        'data' => '&deleteConfirmed=true',
    ),
));

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'primary',
    'label'=> 'Нет',
    'htmlOptions'=>array(
        'name' => 'deleteCanceled'
    ),
));
*/
echo CHtml::submitButton( 'Да', array( 'name' => 'deleteConfirmed' ) );
echo '&nbsp;&nbsp;';
echo CHtml::submitButton( 'Нет', array( 'name' => 'deleteCanceled' ) );

$this->endWidget();
?>