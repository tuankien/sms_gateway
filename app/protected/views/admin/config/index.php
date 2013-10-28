<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Settings'),
    'link' => "#"
);

$this->moduleName = "Config";

$this->slidebar = Backend::getModuleSlideBar('Setting', '/config/index');

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('ConfigCreate')),
	array('label'=>Yii::t('BackEnd', 'Manage configs'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('ConfigAdmin')),
);

$this->title = Yii::t('BackEnd', 'List configs');
?>

<input type="hidden" id="moduleName" value="Config"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'config-grid',
	'dataProvider'=>$dataProvider,
    'selectableRows' => 0,
	'columns'=>array(
		'id',
		'name',
		'value',
		array(
			'class'=>'CButtonColumn',
            'template'=> UserAccess::checkAccess("designPatternUpdate")? '{view}{update}{delete}':'{view}{update}',
		),
	),
)); ?>
