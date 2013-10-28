<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Sms service'),
    'link' => Yii::app()->createUrl("/smsService/index")
);

$this->moduleName = "SmsService";

$this->slidebar = Backend::getModuleSlideBar('Service', '/smsService/index');

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Delete'), 'itemOptions'=>array('style'=>'cursor:pointer', 'onclick'=>'deleteAll("sms-service-grid", "/SmsService/delete");')),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create')),
);

$this->title = Yii::t("BackEnd", "Manage").": ". Yii::t('BackEnd',"Sms Services");
?>
<?php //echo CHtml::link(Yii::t('BackEnd', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::beginForm('#', 'post', array("id"=>"form-admin", "name"=>"frmAdmin")); ?>
<input type="hidden" id="moduleName" value="SmsService"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sms-service-grid',
    'selectableRows' => 2,
	'dataProvider'=>$model->search(),
	'columns'=>array(
        array('class' => 'CCheckBoxColumn'),
		'id',
        array(
            'header'=>Yii::t('BackEnd','Sms keyword'),
            'name'=>'keyword',
            'value'=> '$data->keyword'
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
            'value' => '($data->status == Cp::STATUS_ENABLED)?CHtml::image(Yii::app()->request->baseUrl."/css/admin/images/tick.png", "enabled", array("class"=>"icon-status", "name"=>$data->id)):CHtml::image(Yii::app()->request->baseUrl."/css/admin/images/publish_x.png", "disabled", array("class"=>"icon-status", "name"=>$data->id))',
            'htmlOptions' => array('style'=>'text-align: center;'),
        ),
		array(
            'header'=> Yii::t('BackEnd', 'Actions'),
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php CHtml::endForm();?>