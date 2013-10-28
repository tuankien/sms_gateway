<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Send Sms'),
    'link' => Yii::app()->createUrl("/sendDmsc/index")
);

$this->moduleName = "Send Sms";

$this->slidebar = Backend::getModuleSlideBar('Service', '/sendSms/index');

$this->menu=array(
	//array('label'=>Yii::t('BackEnd', 'Send'), 'url'=>array('index')),
);

$this->title = Yii::t("BackEnd", "Send Sms");
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'SendSms-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php
    if(Yii::app()->user->hasFlash('msg'))
    {
    ?>
    <div class="errorSummary">
        <ul>
            <?php echo Yii::app()->user->getFlash('msg');?>
        </ul>
    </div>
    <?php
    }
    ?>

    <?php
    if($result != '')
    {
        echo '<div style = "color:#F00; font-weight:bolder;">'.Yii::t('Backend', 'Return code').": ".$result.'</div>';
    }
    ?>
    <table id="SendSms-basic-info" class="form-view">
        <tr class="even">
            <th>
                <?php echo CHtml::label(Yii::t('Backend', 'smsc'), 'service_number') ?><span class="required">*</span>
            </th>
            <td>
                <?php echo CHtml::textField('service_number',$_POST['service_number'], array('size'=>'40', 'maxlength'=>'20', 'class'=> 'numbersOnly')) ?>
            </td>
        </tr>
        <tr class="odd">
            <th>
                <?php echo CHtml::label(Yii::t('Backend', 'Reciever'), 'reciever') ?><span class="required">*</span>
            </th>
            <td>
                <?php echo CHtml::textField('reciever',$_POST['reciever'], array('size'=>'40', 'maxlength'=>'20')) ?>
            </td>
        </tr>
        <tr class="even">
            <th>
                <?php echo CHtml::label('Type', 'msg_type') ?><span class="required">*</span>
            </th>
            <td>
                <?php echo CHtml::dropDownList('msg_type', $_POST['msg_type'], $this->dumpTypeToArray(), array('id'=>'msg_type', 'onChange'=>'showWapPush();')) ?>
            </td>
        </tr>
        <tr class="even">
            <th>
                <?php echo CHtml::label('Type', 'charset') ?><span class="required">*</span>
            </th>
            <td>
                <?php echo CHtml::dropDownList('charset', $_POST['charset'], array(SmscUtils::CHARSET_LATIN => "Latin", SmscUtils::CHARSET_UTF8 => "UTF-8")) ?>
            </td>
        </tr>
        <?php
            if($_POST['msg_type'] == SmscUtils::TYPE_WAPPUSH)
            {
                $hide = '';
            }
            else
            {
                $hide = 'style="display:none"';
            }
        ?>
        <tr class="even wap_push" <?php echo $hide; ?>>
            <th><?php echo CHtml::label('Subject','subject'); ?><span class="required">*</span></th>
            <td>
                <?php echo CHtml::textField('subject',$_POST['subject'],array('size'=>40,'maxlength'=>255)); ?>
            </td>
        </tr>
        <tr class="odd">
            <th>
                <?php echo CHtml::label(Yii::t('Backend', 'Contents'), 'content') ?><span class="required">*</span>
            </th>
            <td>
                <?php echo CHtml::textArea('content', $_POST['content'], array('cols'=>'30','rows'=>'6')) ?>
                <br/>
                <?php echo Yii::t('Backend', 'Note').' '.SmscUtils::MAX_LENGTH. ' '.Yii::t('Backend', 'character'); ?>
            </td>
        </tr>
        <tr class="even">
            <th>
            </th>
            <td>
                <input type="submit" style="" name="btn_sendsms" value="Send"/>
            </td>
        </tr>
    </table>
<?php $this->endWidget(); ?>

</div><!-- form -->