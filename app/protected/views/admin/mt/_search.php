<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->request->baseUrl."/js/admin/daterangepicker/js/jquery-ui-1.7.1.custom.min.js");
$cs->registerScriptFile(Yii::app()->request->baseUrl."/js/admin/daterangepicker/js/daterangepicker.jQuery.js");
$cs->registerCssFile(Yii::app()->request->baseUrl."/js/admin/daterangepicker/css/ui.daterangepicker.css");
$cs->registerCssFile(Yii::app()->request->baseUrl."/js/admin/daterangepicker/css/redmond/jquery-ui-1.7.1.custom.css");
$cs->registerScript("daterangepicker","$('.sendTime').daterangepicker({
    dateFormat:'dd/mm/yy',
    arrows:true,
    datepickerOptions:{
        changeMonth: true,
        changeYear: true,
        monthNamesShort: ".Yii::t('BackEnd', "['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']").",
        dayNamesMin: ".Yii::t('BackEnd', "['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa']").",
    }
});");
?>

<div class="wide form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>
    <table>
        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','cp_id'); ?></td>
            <td><?php echo $form->dropDownList($model,'cp_id',$model->dumpAllCpToArray(Yii::t('BackEnd', '-- All --'),$cpList)); ?></td>
        
            <td class="alignRight"><?php echo Yii::t('BackEnd','smsc'); ?></td>
            <td><?php echo $form->dropDownList($model,'smsc',Smsc::dumpAllToArray(Yii::t('BackEnd', '-- All --'))); ?></td>
        </tr>
        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','sms_id'); ?></td>
            <td><?php echo $form->textField($model,'sms_id',array('size'=>20,'maxlength'=>40)); ?></td>
        </tr>
        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','receiver'); ?></td>
            <td><?php echo $form->textField($model,'receiver',array('size'=>20,'maxlength'=>20)); ?></td>

            <td class="alignRight"><?php echo Yii::t('BackEnd','send_time'); ?></td>
            <td><?php echo $form->textField($model, 'send_time', array("class"=>"sendTime", "readonly"=>"readonly")) ; ?></td>
        </tr>
        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','subject'); ?></td>
            <td><?php echo $form->textField($model,'subject',array('size'=>20,'maxlength'=>255)); ?></td>
        
            <td class="alignRight"><?php echo Yii::t('BackEnd','content'); ?></td>
            <td><?php echo $form->textField($model,'content',array('size'=>50,'maxlength'=>255)); ?></td>
        </tr>

        <tr>
            <td class="alignRight"><?php echo Yii::t('BackEnd','status'); ?></td>
            <td><?php echo $form->dropDownList($model,'status',$model->dumpStatusToArray(Yii::t('BackEnd', '-- All --'))); ?></td>
            <td></td>
            <td><?php echo CHtml::submitButton(Yii::t('Global','Search')); ?></td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->