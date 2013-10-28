<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Cps management'),
    'link' => Yii::app()->createUrl("/cp/index")
);

$this->moduleName = "CpGroup";

$this->slidebar = Backend::getModuleSlideBar('Cp', '/cpGroup/index');

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('CpGroupCreate')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('CpGroupAdmin')),
);

$this->title = Yii::t('BackEnd', 'List').": ". Yii::t('BackEnd', 'Cp Groups');
?>

<input type="hidden" id="moduleName" value="CpGroup"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cp-group-grid',
	'dataProvider'=>$dataProvider,
    'selectableRows' => 0,
	'columns'=>array(
		'id',
		'name',
		'sorder',
		array(
			'class'=>'CButtonColumn',
            'template'=> UserAccess::checkAccess("designPatternUpdate")? '{view}{update}{delete}':'{view}{update}',
		),
	),
)); ?>
