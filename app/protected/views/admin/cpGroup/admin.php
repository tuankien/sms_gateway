<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Cps management'),
    'link' => Yii::app()->createUrl("/cp/index")
);

$this->moduleName = "CpGroup";

$this->slidebar = Backend::getModuleSlideBar('Cp', '/cpGroup/index');

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Delete'), 'itemOptions'=>array('style'=>'cursor:pointer', 'onclick'=>'deleteAll("cp-group-grid", "'.Yii::app()->createUrl('/cpGroup/delete').'");')),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create')),
);

$this->title = Yii::t("BackEnd", "Manage").": ". Yii::t('BackEnd',"Cp Groups");
?>
<?php //echo CHtml::link(Yii::t('BackEnd', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php echo CHtml::beginForm('#', 'post', array("id"=>"form-admin", "name"=>"frmAdmin")); ?>
<input type="hidden" id="moduleName" value="cpGroup"/>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cp-group-grid',
    'selectableRows' => 2,
	'dataProvider'=>$model->search(),
	'columns'=>array(
        array('class' => 'CCheckBoxColumn'),
		'id',
		'name',
		array(
            'type'=>'raw',
            'value'=>'CHtml::hiddenField("ids[]", $data->id, array("id"=>"item-".$data->id)).CHtml::textField("sorders[]", $data->sorder, array("id"=>"sorder-".$data->id, "size"=>"4", "class"=>"numbersOnly"));',
            'name'=>'sorder',
            'header'=>Yii::t('BackEnd', 'Sort order').' '.CHtml::image(Yii::app()->request->baseUrl.'/css/admin/images/save.png', 'icon-save', array('style'=>'vertical-align: middle;cursor:pointer;', 'onclick'=>'javascript: $(this).parent().click(function(){return false;});document.frmAdmin.submit();return false;')),
            'htmlOptions'=>array('style'=>'text-align:center'),
        ),
		array(
            'header'=> Yii::t('BackEnd', 'Actions'),
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php CHtml::endForm();?>