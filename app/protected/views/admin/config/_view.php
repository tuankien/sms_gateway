<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Yii::t('Config', 'name'); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo Yii::t('Config', 'value'); ?>:</b>
	<?php echo CHtml::encode($data->value); ?>
	<br />


</div>