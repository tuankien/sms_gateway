<?php

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'SmsService'),
    'link' => "#"
);

$this->moduleName = "SmsService";

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('SmsServiceAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('SmsServiceAdmin')),
    array('label'=>Yii::t('BackEnd', 'Save'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'sms-service-form\').submit()')),
    array('label'=>Yii::t('BackEnd', 'Reset'), 'url'=>'javascript:void(0)', 'linkOptions'=>array('onclick'=>'document.getElementById(\'sms-service-form\').reset()')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'SmsService-basic-info'),
);

$this->title = Yii::t('BackEnd', "Update").": #".$model->id;
?>


<?php echo $this->renderPartial('_form', array('model'=>$model,'error'=>$error,)); ?>