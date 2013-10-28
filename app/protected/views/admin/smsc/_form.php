<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cp-group-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

    <table id="CpGroup-basic-info" class="form-view">
            <tr class="even">
                <th><?php echo $form->labelEx($model,'smsc', array('class'=>'numbersOnly')); ?></th>
                <td>
                    <?php echo $form->textField($model,'smsc',array('size'=>40,'maxlength'=>20,'class'=>"numbersOnly")); ?>
                    <?php echo $form->error($model,'smsc'); ?>
                </td>
            </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->
