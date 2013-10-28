<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo Yii::t('CpGroup', 'name'); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo Yii::t('CpGroup', 'sorder'); ?>:</b>
	<?php echo CHtml::encode($data->sorder); ?>
	<br />


</div>