<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<p class="note"><?php echo Yii::t('application', "Fields with")?> <span class="required">*</span> <?php echo Yii::t("application", "are required")?>.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

    <table id="<?php echo $this->modelClass ?>-basic-info" class="form-view">
<?php
$num = 0;
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
    $num++;
?>
            <tr class="<?php if($num & 1) echo "odd"; else echo "even" ?>">
                <th><?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>"; ?></th>
                <td>
                    <?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
                    <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
                </td>
            </tr>
<?php
}
?>
    </table>
    <input type="submit" style="display:none"/>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->