<?php

$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'CpGroup'),
    'link' => Yii::app()->createUrl("/cpGroup/index")
);

$this->moduleName = "CpGroup";

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('CpGroupCreate')),
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('CpGroupUpdate')),
	array('label'=>Yii::t('BackEnd', 'Delete'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('CpGroupDelete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('application', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>!UserAccess::checkAccess('CpGroupAdmin')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('CpGroupAdmin')),
);

$this->slidebar=array(
	array('label'=>Yii::t('BackEnd','Basic Infomation'), 'name'=>'basic-info', 'rel'=>'CpGroup-basic-info'),
);

$this->title = $model->name;
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'sorder',
	),
)); ?>
