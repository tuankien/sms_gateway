<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo strtr(Yii::t('BackEnd', 'The fields {*} are required.'), array('{*}'=>'<span class="required">*</span>'))?></p>

    <table id="AdminUser-basic-info" class="form-view">
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'username'); ?></th>
                <td>
                <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'username'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'email'); ?></th>
                <td>
                <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'email'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'password'); ?></th>
                <td>
                <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'password'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'first_name'); ?></th>
                <td>
                <?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'first_name'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'last_name'); ?></th>
                <td>
                <?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'last_name'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'phone'); ?></th>
                <td>
                <?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'phone'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'company'); ?></th>
                <td>
                <?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'company'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'status'); ?></th>
                <td>
                <?php echo $form->dropDownList($model,'status',AdminUser::model()->getStatusArray()); ?>
                <?php echo $form->error($model,'status'); ?>
                </td>
            </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->