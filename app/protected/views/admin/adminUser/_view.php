<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Yii::t('BackEnd', 'username'); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo Yii::t('BackEnd', 'email'); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo Yii::t('BackEnd', 'password'); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo Yii::t('BackEnd', 'first_name'); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo Yii::t('BackEnd', 'last_name'); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo Yii::t('BackEnd', 'phone'); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<?php /*
	<b><?php echo Yii::t('BackEnd', 'company'); ?>:</b>
	<?php echo CHtml::encode($data->company); ?>
	<br />

	<b><?php echo Yii::t('BackEnd', 'status'); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>