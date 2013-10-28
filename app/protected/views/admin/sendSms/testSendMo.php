<?php
/*
 * Create Smsc
 */
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Test sendMo'),
    'link' => Yii::app()->createUrl("/sendSms/testSendMo")
);

$this->moduleName = "SendSms";

$this->menu=array(
//    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'send-mo-form\').submit()')),
);

$this->slidebar = Backend::getModuleSlideBar('Service', '/sendSms/testSendMo');

$this->title = Yii::t('BackEnd', "Test mo");
?>
<div class="form">
<?php if(Yii::app()->user->hasFlash('smsResult')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('smsResult'); ?>
</div>
<?php endif; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'send-mo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<table id="sendMo-basic-info" class="form-view">
        <tr class="odd">
            <th><?php echo $form->labelEx($model,'sender'); ?></th>
            <td>
                <?php echo $form->textField($model,'sender',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo $form->error($model,'sender'); ?>
            </td>
        </tr>
        <tr class="even">
            <th><?php echo $form->labelEx($model,'service_number'); ?></th>
            <td>
                <?php echo $form->textField($model,'service_number',array('size'=>10,'maxlength'=>10)); ?>
                <?php echo $form->error($model,'service_number'); ?>
            </td>
        </tr>

        <tr class="odd">
            <th><?php echo $form->labelEx($model,'content'); ?></th>
            <td>
                <?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'content'); ?>
            </td>
        </tr>
        <tr class="even">
            <th><?php echo $form->labelEx($model,'keyword'); ?></th>
            <td>
                <?php echo $form->textField($model,'keyword',array('size'=>20,'maxlength'=>20)); ?>
                <?php echo $form->error($model,'keyword'); ?>
            </td>
        </tr>
        <tr class="odd">
            <th><?php echo $form->labelEx($model,'first_param'); ?></th>
            <td>
                <?php echo $form->textField($model,'first_param',array('size'=>20)); ?>
                <?php echo $form->error($model,'service_number'); ?>
            </td>
        </tr>
        <tr class="even">
            <th><?php echo $form->labelEx($model,'last_param'); ?></th>
            <td>
                <?php echo $form->textField($model,'last_param',array('size'=>20)); ?>
                <?php echo $form->error($model,'last_param'); ?>
            </td>
        </tr>
        <tr class="odd">
            <th><?php echo $form->labelEx($model,'smsc'); ?></th>
            <td>
                <?php echo $form->textField($model,'smsc',array('size'=>10)); ?>
                <?php echo $form->error($model,'smsc'); ?>
            </td>
        </tr>
        <tr class="even">
            <th><?php echo Yii::t("BackEnd",'sms_id'); ?></th>
            <td>
                <?php echo $form->textField($model,'sms_id',array('size'=>32,'maxlength'=>60)); ?>
                <?php echo $form->error($model,'sms_id'); ?>
            </td>
        </tr>
        <tr class="odd">
            <th>
            </th>
            <td>
                <input type="submit" style="" name="btn_sendsms" value="Send"/>
            </td>
        </tr>
    </table>
    <input type="submit" style="display:none"/>
<?php $this->endWidget(); ?>

</div><!-- form -->
