<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
    <table>
        <tr>
            <td class="alignRight">
                <?php echo Yii::t('BackEnd','id'); ?>
                <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
            </td>
            <td>
                <?php echo Yii::t('BackEnd','smsc'); ?>
                <?php echo $form->textField($model,'smsc',array('size'=>40,'maxlength'=>255)); ?>
            </td>
             <td class="alignLeft">
                 <?php echo CHtml::submitButton(Yii::t('Global','Search')); ?>
             </td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- search-form -->