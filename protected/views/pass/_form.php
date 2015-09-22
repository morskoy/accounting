<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pass-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model,'id_user', Chtml::listData(User::model()->findAll( array('order' => 'last_name')),'id','ShortFio'), array('class'=>'span4')); ?>

	<?php echo $form->dropDownListRow($model,'id_programm', Chtml::listData(PassProgramm::model()->findAll(),'id','programm'), array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'login',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'pass',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50,'class'=>'span5',  'maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
