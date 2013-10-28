<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'name'); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'group_id'); ?>:</b>
	<?php echo CHtml::encode($data->group_id); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'username'); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'password'); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'smsc'); ?>:</b>
	<?php echo CHtml::encode($data->smsc); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'created_time'); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	<?php /*
	<b><?php echo Yii::t('Cp', 'updated_time'); ?>:</b>
	<?php echo CHtml::encode($data->updated_time); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'created_by'); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo Yii::t('Cp', 'status'); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>