<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cp-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <table id="Cp-basic-info" class="form-view">
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'name'); ?></th>
                <td>
                    <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'name'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'group_id'); ?></th>
                <td>
                    <?php echo $form->dropDownList($model,'group_id', CpGroup::dumpAllCpGroupToArray(Yii::t('BackEnd', '-- Select one --')) , array()); ?>
                    <?php echo $form->error($model,'group_id'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'username'); ?></th>
                <td>
                    <?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>45)); ?>
                    <?php echo $form->error($model,'username'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'password'); ?></th>
                <td>
                    <?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>32)); ?>
                    <?php echo $form->error($model,'password'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th>
                    <?php echo $form->labelEx($model,'smsc'); ?>
                    <div>(<?php echo Yii::t('Backend', 'Only for sendMT')?>)</div>
                </th>
                <td>
                    <?php echo $form->textField($model,'smsc',array('size'=>60,'maxlength'=>200)); ?>
                    <?php echo $form->error($model,'smsc'); ?>
                    <div><?php echo Yii::t('BackEnd', 'msg_smsc')?></div>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'admin_id'); ?></th>
                <td>
                    <?php echo $form->dropDownList($model,'admin_id', $model->dumpAllAdminIdToArray(Yii::t('BackEnd', '-- Select one --')) , array()); ?>
                    <?php echo $form->error($model,'admin_id'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'Active'); ?></th>
                <td>
                    <?php echo $form->checkBox($model, 'status',
                        array(),
                        array('options' => array(Cp::STATUS_ENABLED=>array('checked'=>true))
                    )); ?>
                    <?php echo $form->error($model,'status'); ?>
                </td>
            </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->