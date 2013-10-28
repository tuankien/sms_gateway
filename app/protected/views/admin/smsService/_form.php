<?php
    Yii::app()->clientScript->registerScript('search', "
    $('.protocol').click(function(){
        $('.menthod_soap').toggle('3000');
        return false;
    });
    ");
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sms-service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <table id="SmsService-basic-info" class="form-view">
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'cp_id'); ?></th>
                <td>
                    <?php echo $form->dropDownList($model,'cp_id', SmsService::dumpAllCpToArray(Yii::t('BackEnd', '-- Select one --')) , array()); ?>
                    <?php echo $form->error($model,'cp_id'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'smsc'); ?></th>
                <td>
                    <?php echo $form->textField($model,'smsc',array('size'=>60,'maxlength'=>200)); ?>
                    <div><?php echo Yii::t('BackEnd', 'msg_smsc')?></div>
                    <?php echo $form->error($model,'smsc'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'Sms keyword'); ?></th>
                <td>
                    <?php echo $form->textField($model,'keyword',array('size'=>60,'maxlength'=>255)); ?>
                    <div><?php echo Yii::t('BackEnd', 'wildcard_keyword')?></div>
                    <?php echo $form->error($model,'keyword'); ?>
                    <div id='showDuplicateService'></div>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'keyword_type'); ?></th>
                <td>
                    <?php echo $form->dropDownList($model,'keyword_type', SmsService::dumpCompareKeywordToArray() , array()); ?>
                    <?php echo $form->error($model,'keyword_type'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,  Yii::t("BackEnd","protocol")); ?></th>
                <td>
                    <?php echo $form->dropDownList($model,'protocol', SmsService::dumpProtocolToArray() , array('id'=>'protocol', 'onChange'=>'showMenthodSoap();')); ?>
                    <?php echo $form->error($model,'protocol '); ?>
                </td>
            </tr>
            <tr class="even">
                <th><div class="http" style="display: none"><?php echo $form->labelEx($model,'get_url'); ?></div>
                    <div class="wsdl"><?php echo $form->labelEx($model,'wsdl_url'); ?><span class="required">*</span></div>
                </th>
                <td>
                    <?php echo $form->textField($model,'get_url',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'get_url'); ?>
                </td>
            </tr>
            <?php
            if($model->protocol == "HTTP")
            {
                $hide = 'style="display:none"';
            }
            ?>
            <tr class="even menthod_soap" <?php echo $hide; ?>>
                <th><?php echo $form->labelEx($model,'menthod_name'); ?><span class="required">*</span></th>
                <td>
                    <?php echo $form->textField($model,'method_name',array('size'=>60,'maxlength'=>255)); ?>
                    <?php echo $form->error($model,'method_name'); ?>
                    <?php
                    if($error != '')
                    {
                        echo '<div class="errorMessage">'.$error.'</div>';
                    }
                    ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'params'); ?></th>
                <td>
                    <?php echo $form->textField($model,'params',array('size'=>60,'maxlength'=>500)); ?>
                    <div><?php echo Yii::t("BackEnd", "Chuỗi tham số gửi tới dịch vụ, ví dụ: username=<strong>admin</strong>&password=<strong>xxx</strong>"); ?></div>
                    <?php echo $form->error($model,'params'); ?>
                </td>
            </tr>
            <tr class="even">
                <th><?php echo $form->labelEx($model,'system_params'); ?></th>
                <td>
                    <?php echo $form->textField($model,'system_params',array('size'=>60,'maxlength'=>255)); ?>
                    <div><?php echo Yii::t("BackEnd", "<strong>ALL</strong> hoặc các tham số cách nhau bởi dấu ',': {systemParams}", array('{systemParams}' => implode(", ", Yii::app()->params['systemParams']))); ?></div>
                    <?php echo $form->error($model,'system_params'); ?>
                </td>
            </tr>
            <tr class="odd">
                <th><?php echo $form->labelEx($model,'Active'); ?></th>
                <td>
                   <?php echo $form->checkBox($model, 'status',
                        array(),
                        array('options' => array(SmsService::STATUS_ENABLED=>array('checked'=>true))
                    )); ?>
                    <?php echo $form->error($model,'status'); ?>
                </td>
            </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->