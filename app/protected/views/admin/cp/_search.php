<div class="wide form">
    <table>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
        'id'=>'frmSearch',
    )); ?>

        <tr>
            <td class="alignRight">
                <?php echo Yii::t('BackEnd','Cp name'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model,'id', Cp::dumpAllCpToArray(Yii::t('BackEnd', '-- All --')) , array('onchange'=>'javascript:$("#frmSearch").submit();')); ?>
            </td>

            <td class="alignRight">
                <?php echo Yii::t('BackEnd','group_id'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model,'group_id', CpGroup::dumpAllCpGroupToArray(Yii::t('BackEnd', '-- All --')) , array('onchange'=>'javascript:$("#frmSearch").submit();')); ?>
            </td>
        </tr>
        <tr>
            <td class="alignRight">
                <?php echo Yii::t('BackEnd','smsc'); ?>
            </td>
            <td>
                <?php echo $form->textField($model,'smsc',array('size'=>17,'maxlength'=>200)); ?>
            </td>

            <td class="alignRight">
                <?php echo Yii::t('BackEnd','admin_id'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model,'admin_id', $model->dumpAllAdminIdToArray(Yii::t('BackEnd', '-- Tất cả --')) , array()); ?>
            </td>
        </tr>
        <tr>
            <td class="alignRight">
                <?php echo Yii::t('BackEnd','status'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model, 'status', Cp::dumpStatusToArray(Yii::t('BackEnd','-- All --')) , array('onchange'=>'javascript:$("#frmSearch").submit();')); ?>
            </td>

            <td colspan="2" class="center">
                <?php echo CHtml::submitButton(Yii::t('Global','Search')); ?>
            </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->