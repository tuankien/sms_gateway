<?php

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Config'),
    'link' => Yii::app()->request->baseUrl.'/config/index.html',
);

$this->moduleName = "Config";

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('ConfigCreate')),
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('ConfigUpdate')),
	array('label'=>Yii::t('BackEnd', 'Delete'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('ConfigDelete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('application', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('ConfigAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('ConfigAdmin')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic information'), 'name'=>'basic-info', 'rel'=>'Config-basic-info'),
);

$this->title = Yii::t('BackEnd', 'Detail information');
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'value',
        'comment',
	),
)); ?>
