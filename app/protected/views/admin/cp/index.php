<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Cps management'),
    'link' => Yii::app()->createUrl("/cp/index")
);

$this->moduleName = "Cp";

$this->slidebar=array();

foreach($cp_groups as $key => $group)
{
    $this->slidebar["/cp/index/group_id/".$group->id] = array('label'=>$group->name, 'url'=>"/cp/index/group_id/".$group->id);
}
if($group_id)
    $this->slidebar["/cp/index/group_id/".$group_id]['class'] = 'active';
else
    $this->slidebar[$cp_groups[0]->id]['class'] = 'active';

$this->menu=array(
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('CpCreate')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('CpAdmin')),
    array('label'=>Yii::t('BackEnd', 'Cp groups manager'), 'url'=>array('/cpGroup/index'), 'visible'=>UserAccess::checkAccess('CpGroupIndex')),
);

$this->title = Yii::t('BackEnd', 'List').": ". Yii::t('BackEnd', 'Cps');
?>

<input type="hidden" id="moduleName" value="Cp"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cp-grid',
	'dataProvider'=>$dataProvider,
    'selectableRows' => 0,
	'columns'=>array(
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
        array(
            'name'=>'admin_id',
            'value'=> 'AdminUser::model()->findByPk($data->admin_id)->username'
        ),
        array(
            'name' => 'status',
            'header' => Yii::t('BackEnd', 'Status'),
            'type' => 'raw',
            'value' => '($data->status == Cp::STATUS_ENABLED)?CHtml::image(Yii::app()->request->baseUrl."/css/admin/images/tick.png", "enabled", array("class"=>"icon-status", "name"=>$data->id)):CHtml::image(Yii::app()->request->baseUrl."/css/admin/images/publish_x.png", "disabled", array("class"=>"icon-status", "name"=>$data->id))',
            'htmlOptions' => array('style'=>'text-align: center;'),
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=> UserAccess::checkAccess("designPatternUpdate")? '{view}{update}{delete}':'{view}{update}',
		),
	),
)); ?>
