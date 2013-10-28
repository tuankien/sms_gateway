<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Settings'),
    'link' => "#"
);

$this->moduleName = "Config";

$this->slidebar = Backend::getModuleSlideBar('Setting', '/config/index');

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Delete'), 'itemOptions'=>array('style'=>'cursor:pointer', 'onclick'=>'deleteAll("config-grid", "/Config/delete");')),
	array('label'=>Yii::t('BackEnd', 'List configs'), 'url'=>array('index')),
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create')),
);

$this->title = Yii::t("BackEnd", "Manage configs");
?>
<?php //echo CHtml::link(Yii::t('BackEnd', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php
$this->renderPartial('_search',array(
	'model'=>$model,
));
?>
</div><!-- search-form -->

<?php echo CHtml::beginForm('#', 'post', array("id"=>"form-admin", "name"=>"frmAdmin")); ?>
<input type="hidden" id="moduleName" value="Config"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'config-grid',
	'selectableRows' => 2,
	'dataProvider'=>$model->search(),
	'columns'=>array(
        array('class' => 'CCheckBoxColumn'),
		'id',
		'name',
		'value',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php echo CHtml::endForm(); ?>