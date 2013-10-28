<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cp-group-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

    <table id="CpGroup-basic-info" class="form-view">
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'name'); ?></th>
                <td>
                    <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'name'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'sorder', array('class'=>'numbersOnly')); ?></th>
                <td>
                    <?php echo $form->textField($model,'sorder',array('size'=>5,'maxlength'=>10)); ?>
                    <?php echo $form->error($model,'sorder'); ?>
                </td>
            </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->