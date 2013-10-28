<?php
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', 'Statistics & Reports'),
    'link' => "#"
);

$this->moduleName = "Mt";

$this->slidebar = Backend::getModuleSlideBar('Statistics', '/mt/index');

$this->menu=array();

$this->title = Yii::t('BackEnd', 'List MT sms');
?>

<div class="search-form">
    <?php
    $this->renderPartial('_search',array(
        'model'=>$model,
        'cpList'=>$cpList,
    ));
    Yii::app()->clientScript->registerScript('search', "
        $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('mt-grid', {
                data: $(this).serialize()
            });
            return false;
        });
    ");
    ?>
</div>

<input type="hidden" id="moduleName" value="mo"/>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mt-grid',
	'dataProvider'=>$model->search(),
    'selectableRows' => 0,
	'columns'=>array(
		'id',
		array(
            'header' => Yii::t('BackEnd', "cp_id"),
            'type' => 'raw',
            'value' => '$data->cp->name',
            'htmlOptions' => array('style'=>'text-align: center;'),
        ),
		'smsc',
		'sms_id',
        'subject',
        'content',
		'sender',
		'send_time',
        'receiver',
		//'status',
        array(
            'name' => 'status',
            'value' => '$data->getStatusLabel()',
        ),
	),
)); ?>