<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'CpGroup'),
    'link' => Yii::app()->createUrl("/cpGroup/index")
);

$this->moduleName = "Smsc";

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('SmscCreate')),
	array('label'=>Yii::t('BackEnd', 'Update'), 'url'=>array('update', 'id'=>$model->id), 'visible'=>UserAccess::checkAccess('SmscUpdate')),
	array('label'=>Yii::t('BackEnd', 'Delete'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('SmscDelete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('application', 'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index'), 'visible'=>UserAccess::checkAccess('SmscAdmin')),
	//array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('SmscAdmin')),
);

$this->slidebar = Backend::getModuleSlideBar('Setting', '/smsc/index');

$this->title = 'Smsc';
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'smsc',
	),
)); ?>
