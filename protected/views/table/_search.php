<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>5)); ?>

		<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'day1_code',array('class'=>'span5','maxlength'=>4)); ?>

    <?php echo $form->dropDownListRow($model_1, 'who_table',  CHtml::listData(User::model()->findAll(array('condition'=>'edit_table=1', 'order' => 'last_name ASC')),'id','last_name')); ?>



		<?php echo $form->textFieldRow($model,'date_completion',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Create',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
