<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Cps management'),
    'link' => Yii::app()->createUrl("/cp/index")
);

$this->slidebar=array();

foreach($cp_groups as $key => $group)
{
    $this->slidebar["/cp/admin/group_id/".$group->id] = array('label'=>$group->name, 'url'=>"/cp/admin/group_id/".$group->id);
}
if($group_id)
    $this->slidebar["/cp/admin/group_id/".$group_id]['class'] = 'active';
else
    $this->slidebar[$cp_groups[0]->id]['class'] = 'active';



$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Delete'), 'itemOptions'=>array('style'=>'cursor:pointer', 'onclick'=>'deleteAll("cp-grid", "/Cp/delete");')),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create')),
    array('label'=>Yii::t('BackEnd', 'Cp groups manager'), 'url'=>array('/cpGroup/index'), 'visible'=>UserAccess::checkAccess('CpGroupIndex')),
);

$this->title = Yii::t("BackEnd", "Manage").": ". Yii::t('BackEnd',"Cps");
?>
<?php //echo CHtml::link(Yii::t('BackEnd', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::beginForm('#', 'post', array("id"=>"form-admin", "name"=>"frmAdmin")); ?>
<?php echo CHtml::hiddenField('moduleName', 'Cp', array('id'=>'moduleName')); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cp-grid',
    'selectableRows' => 2,
	'dataProvider'=>$model->search(),
	'columns'=>array(
        array('class' => 'CCheckBoxColumn'),
		'id',
        array(
            'header'=>Yii::t('BackEnd', 'Cp name'),
            'name'=> 'name',
            'value'=> $data->name
        ),
		array(
            'name'=>'group_id',
            'value'=>'CpGroup::model()->findByPk($data->group_id)->name'
        ),
		'username',
//		'password',
//		'smsc',
        'admin_id',
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