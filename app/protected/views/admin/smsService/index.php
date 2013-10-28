<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Sms service'),
    'link' => "#"
);

$this->moduleName = "SmsService";

$this->slidebar = Backend::getModuleSlideBar('Service', '/smsService/index');

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('SmsServiceCreate')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('SmsServiceAdmin')),
);

$this->title = Yii::t('BackEnd', 'List').": ". Yii::t('BackEnd', 'Sms Services');
?>

<input type="hidden" id="moduleName" value="SmsService"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sms-service-grid',
	'dataProvider'=>$dataProvider,
    'selectableRows' => 0,
	'columns'=>array(
		'id',
        array(
            'header' => Yii::t('BackEnd', 'Sms keyword'),
            'name'=>'keyword',
            'value'=>'$data->keyword'
        ),
        array(
            'header' => Yii::t('BackEnd', 'keyword_type'),
            'name'=>'keyword_type',
            'value'=> '$data->getCompareKeywordLabel()'
        ),
        array(
            'header' => Yii::t('BackEnd', 'Cp name'),
            'name'=>'cp_id',
            'value'=> 'Cp::model()->findByPk($data->cp_id)->name'
        ),
        'smsc',
        'protocol',
        array(
            'name' => 'status',
            'header' => Yii::t('BackEnd', 'Status'),
            'type' => 'raw',
            'value' => '($data->status == SmsService::STATUS_ENABLED)?CHtml::image(Yii::app()->request->baseUrl."/css/admin/images/tick.png", "enabled", array("class"=>"icon-status", "name"=>$data->id)):CHtml::image(Yii::app()->request->baseUrl."/css/admin/images/publish_x.png", "disabled", array("class"=>"icon-status", "name"=>$data->id))',
            'htmlOptions' => array('style'=>'text-align: center;'),
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=> UserAccess::checkAccess("designPatternUpdate")? '{view}{update}{delete}':'{view}{update}',
		),
	),
)); ?>
