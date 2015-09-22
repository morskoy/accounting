<?php if(!$model->isNewRecord):?>
    <?php echo $form->textFieldRow($model, 'login'); ?>
    <?php echo $form->textFieldRow($model, 'newPassword'); ?>
    <?php echo $form->textFieldRow($model, 'verifyPassword'); ?>
<?php endif; ?>
<?php if($model->isNewRecord):?>
    <?php echo $form->textFieldRow($model, 'password'); ?>
<?php endif; ?>
<?php echo $form->textFieldRow($model, 'email'); ?>
<?php echo $form->textFieldRow($model, 'tel_int'); ?>
<?php echo $form->textFieldRow($model, 'tel_mobile'); ?>
<?php echo $form->dropDownListRow($model, 'active', $model->userStatus); ?>
<?php if(Yii::app()->user->checkAccess('administrator')):?>
    <?php echo $form->dropDownListRow($model, 'role',  CHtml::listData(UserRole::model()->findAll(),'role','role_rus')); ?>
<?php endif; ?>