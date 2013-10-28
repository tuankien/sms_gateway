
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo strtr(Yii::t('BackEnd', 'The fields {*} are required.'), array('{*}'=>'<span class="required">*</span>'))?></p>

    <table id="Config-basic-info" class="form-view">
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'host'); ?></th>
                <td>
                    <?php echo $form->textField($model,'host',array('size'=>60,'maxlength'=>255)); ?>
                    <div><?php echo Yii::t("BackEnd",'Host url without http:// string'); ?></div>
                    <?php echo $form->error($model,'host'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'username'); ?></th>
                <td>
                    <?php
                        echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45));
                    ?>
                    <?php echo $form->error($model,'username'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'password'); ?></th>
                <td>
                    <?php
                        echo $form->textField($model,'password',array('size'=>45,'maxlength'=>45));
                    ?>
                    <?php echo $form->error($model,'password'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'country_code'); ?></th>
                <td>
                    <?php echo $form->textField($model,'country_code',array('size'=>20,'maxlength'=>5)); ?>
                    <?php echo $form->error($model,'country_code'); ?>
                </td>
            </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->

