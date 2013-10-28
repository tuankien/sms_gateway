<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo strtr(Yii::t('BackEnd', 'The fields {*} are required.'), array('{*}'=>'<span class="required">*</span>'))?></p>

    <table id="Config-basic-info" class="form-view">
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'name'); ?></th>
                <td>
                    <?php
                        if($model->id) echo CHtml::label($model->name, '');
                        else echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45));
                    ?>
                    <?php echo $form->error($model,'name'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'value'); ?></th>
                <td>
                    <?php echo $form->textArea($model,'value',array('cols' => '40')); ?>
                    <?php echo $form->error($model,'value'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'comment'); ?></th>
                <td>
                    <?php echo $form->textArea($model,'comment',array('cols' => '40')); ?>
                    <?php echo $form->error($model,'comment'); ?>
                </td>
            </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->