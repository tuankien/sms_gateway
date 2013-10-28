<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'cp_id'); ?>:</b>
	<?php echo CHtml::encode($data->cp_id); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'smsc'); ?>:</b>
	<?php echo CHtml::encode($data->smsc); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'keyword'); ?>:</b>
	<?php echo CHtml::encode($data->keyword); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'get_url'); ?>:</b>
	<?php echo CHtml::encode($data->get_url); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'system_params'); ?>:</b>
	<?php echo CHtml::encode($data->system_params); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'created_time'); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	<?php /*
	<b><?php echo Yii::t('SmsService', 'updated_time'); ?>:</b>
	<?php echo CHtml::encode($data->updated_time); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'updated_by'); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo Yii::t('SmsService', 'status'); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>