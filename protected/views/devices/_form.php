<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'devices-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->labelEx($model,'id_unit'); ?>
    <?php echo $form->dropDownList($model,'id_unit',CHtml::listData(Units::model()->findAll(),'id','unit'), array(
        'class'=>'span4',
        'ajax'=>array(
            'type'=>'POST', //request type
            'url'=>$this->createUrl('devices/getManufactures'), //url to call.
            'update'=>'#id_manufacture'
        )
    ));
    ?>

    <?php echo $form->labelEx($model,'id_manufacture'); ?>
    <?php echo $form->dropDownList($model,'id_manufacture','', array()
        ); ?>

    <?php echo $form->labelEx($model,'id_model'); ?>
	<?php //echo $form->dropDownList($model,'id_model','',array('class'=>'span4')); ?>

    <?php echo $form->labelEx($model,'id_user'); ?>
	<?php echo $form->dropDownList($model,'id_user', CHtml::listData(User::model()->findAll(),'id','last_name'), array('class'=>'span4')); ?>

    <?php echo $form->labelEx($model,'department'); ?>
	<?php echo $form->dropDownList($model,'id_department', CHtml::listData(Department::model()->findAll(),'id','department'), array('class'=>'span4')); ?>

    <?php echo $form->labelEx($model,'id_place'); ?>
	<?php echo $form->dropDownList($model,'id_place', CHtml::listData(Places::model()->findAll(),'id','place'), array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'sn',array('class'=>'span4','maxlength'=>50)); ?>

    <?php echo $form->labelEx($model,'ip'); ?>
    <?php echo $form->textField($model,'ip_1',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>
    <?php echo $form->textField($model,'ip_2',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>
    <?php echo $form->textField($model,'ip_3',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>
    <?php echo $form->textField($model,'ip_4',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>

    <?php echo $form->labelEx($model,'mask'); ?>
    <?php echo $form->textField($model,'mask_1',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>
    <?php echo $form->textField($model,'mask_2',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>
    <?php echo $form->textField($model,'mask_3',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>
    <?php echo $form->textField($model,'mask_4',array('class'=>'span1','maxlength'=>3,'size'=>3)); ?>


	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
