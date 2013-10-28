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
	array('label'=>Yii::t('BackEnd', 'Create'), 'url'=>array('create'), 'visible'=>UserAccess::checkAccess('<?php echo $this->modelClass;?>Create')),
	array('label'=>Yii::t('BackEnd', 'Manage'), 'url'=>array('admin'), 'visible'=>UserAccess::checkAccess('<?php echo $this->modelClass;?>Admin')),
);

$this->title = Yii::t('BackEnd', 'List').": ". Yii::t('BackEnd', '<?php echo $this->pluralize($this->class2name($this->modelClass)); ?>');
?>

<input type="hidden" id="moduleName" value="<?php echo $this->modelClass ?>"/>
<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$dataProvider,
    'selectableRows' => 0,
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
            'template'=> UserAccess::checkAccess("designPatternUpdate")? '{view}{update}{delete}':'{view}{update}',
		),
	),
)); ?>
