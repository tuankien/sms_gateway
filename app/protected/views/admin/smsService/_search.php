<div class="wide form">
    <table border="0">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
        'id'=>'frmSearch'
    )); ?>

        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','cp_id'); ?></td>
            <td><?php echo $form->dropDownList($model,'cp_id', SmsService::dumpAllCpToArray(Yii::t('BackEnd', '-- All --')) , array('onchange'=>'javascript:$("#frmSearch").submit();')); ?></td>

            <td class="alignRight"><?php echo Yii::t('BackEnd','smsc'); ?></td>
            <td><?php echo $form->textField($model,'smsc',array('size'=>20,'maxlength'=>200)); ?></td>
        </tr>
        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','keyword'); ?></td>
            <td><?php echo $form->textField($model,'keyword',array('size'=>28,'maxlength'=>255)); ?></td>

            <td class="alignRight"><?php echo Yii::t('BackEnd','protocol'); ?></td>
            <td><?php echo $form->dropDownList($model, 'protocol', SmsService::dumpProtocolToArray(Yii::t('BackEnd','-- All --'))); ?></td>
        </tr>
        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','status'); ?></td>
            <td><?php echo $form->dropDownList($model, 'status', SmsService::dumpStatusToArray(Yii::t('BackEnd','-- All --'))); ?></td>
            
            <td/>
            <td><?php echo CHtml::submitButton(Yii::t('Global','Search')); ?></td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->