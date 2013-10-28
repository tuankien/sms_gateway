<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
?>
$this->breadcrumbs=array();

$this->sidebarTop = array(
    'label' => Yii::t('BackEnd', '<?php echo $this->modelClass;?>'),
    'link' => "#"
);

$this->moduleName = "<?php echo $this->modelClass ?>";

$this->slidebar = array();

$this->menu=array(
    array('label'=>Yii::t('BackEnd', 'Delete'), 'itemOptions'=>array('style'=>'cursor:pointer', 'onclick'=>'deleteAll("form-admin", "/<?php echo $this->modelClass ?>/delete");')),
	array('label'=>Yii::t('BackEnd', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create')),
);

$this->title = Yii::t("BackEnd", "Manage").": ". Yii::t('BackEnd',"<?php echo $this->pluralize($this->class2name($this->modelClass)); ?>");
?>
<?php echo "<?php //echo CHtml::link(Yii::t('BackEnd', 'Advanced Search'),'#',array('class'=>'search-button')); ?>"; ?>

<div class="search-form">
    <?php
    echo "<?php \$this->renderPartial('_search',array(
        'model'=>\$model,
    )); ?>\n";

    echo "<?php Yii::app()->clientScript->registerScript('search', \"
        $('.search-button').click(function(){
            $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('".$this->class2id($this->modelClass)."-grid', {
                data: $(this).serialize()
            });
            return false;
        });
    \");?>\n";
    ?>
</div><!-- search-form -->

<form action="" method="post" name="frmAdmin" id="form-admin">
<input type="hidden" id="moduleName" value="<?php echo $this->modelClass ?>"/>
<?php echo "<?php"; ?> $this->widget('application.widgets.admin.GridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</form>