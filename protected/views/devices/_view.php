<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_unit')); ?>:</b>
	<?php echo CHtml::encode($data->id_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_manufacture')); ?>:</b>
	<?php echo CHtml::encode($data->id_manufacture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_model')); ?>:</b>
	<?php echo CHtml::encode($data->id_model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_department')); ?>:</b>
	<?php echo CHtml::encode($data->id_department); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_place')); ?>:</b>
	<?php echo CHtml::encode($data->id_place); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sn')); ?>:</b>
	<?php echo CHtml::encode($data->sn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	*/ ?>

</div>