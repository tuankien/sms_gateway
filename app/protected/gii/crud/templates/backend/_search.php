<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<div class="wide form">
    <table>
    <?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl(\$this->route),
        'method'=>'get',
    )); ?>\n"; ?>

    <?php foreach($this->tableSchema->columns as $column): ?>
    <?php
        $field=$this->generateInputField($this->modelClass,$column);
        if(strpos($field,'password')!==false)
            continue;
    ?>
<tr>
            <td class="alignRight"><?php echo "<?php echo Yii::t('BackEnd','{$column->name}'); ?>"; ?></td>
            <td><?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>"; ?></td>
        </tr>

    <?php endforeach; ?>
    <tr>
            <td colspan="2" class="center"><?php echo "<?php echo CHtml::submitButton(Yii::t('Global','Search')); ?>"; ?></td>
        </tr>
    </table>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->