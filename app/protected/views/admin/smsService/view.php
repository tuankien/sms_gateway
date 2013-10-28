<?php

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Sms Service'),
    'link' => Yii::app()->createUrl("/smsService/index")
);

$this->moduleName = "SmsService";

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Duplicate'), 'url'=>array('duplicate', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('SmsServiceCreate')),
    array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('SmsServiceCreate')),
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('SmsServiceUpdate')),
	array('label'=>Yii::t('BackEnd', 'Delete'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('SmsServiceDelete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id, 'YII_CSRF_TOKEN'=>$this->YII_CSRF_TOKEN),'confirm'=>Yii::t('application', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('SmsServiceAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('SmsServiceAdmin')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'SmsService-basic-info'),
);

$this->title = $model->id;
?>
<?php echo CHtml::beginForm('#', 'post', array("id"=>"form-view", "name"=>"frmView")); ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        array(
            'name'=>'cp_id',
            'value'=> Cp::model()->findByPk($model->cp_id)->name
        ),
		'smsc',
		'keyword',
        array(
            'name'=>'keyword_type',
            'value'=> $model->getCompareKeywordLabel(),
        ),
		'get_url',
        'protocol',
        'method_name',
        'params',
		'system_params',
        'created_time',
		'updated_time',
        array(
            'name'=>'updated_by',
            'value'=> AdminUser::model()->findByPk($model->updated_by)->username
        ),
        array(
            'name'=>'staus',
            'value'=> ($model->status == SmsService::STATUS_ENABLED)? Yii::t('BackEnd', 'Enabled') : Yii::t('BackEnd', 'Disabled')
        ),
	),
)); ?>
<?php CHtml::endForm();?>