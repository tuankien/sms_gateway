<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
        'Login',
);
?>
<div class="form clearfix">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableAjaxValidation'=>true,
    )); ?>

    <?php if($model->getErrors()):?>
    <div class="row" style="text-align:center">
        <?php
            echo $form->error($model,'username');
            echo $form->error($model,'password');
        ?>
    </div>
    <?php endif;?>

    <div class="row clearfix">
        <div class="cell first w140"><?php echo $form->labelEx($model,'username'); ?></div>
        <div class="cell">
            <?php echo $form->textField($model,'username', array('class'=>'text', 'style'=> "width:240px")); ?>
        </div>
    </div>

    <div class="row clearfix">
        <div class="cell first w140"><?php echo $form->labelEx($model,'password'); ?></div>
        <div class="cell">
            <?php echo $form->passwordField($model,'password', array('class'=>'text', 'style'=> "width:240px")); ?>
        </div>
    </div>

    <?php if(count(Yii::app()->params['languages']) > 1):?>
    <div class="row clearfix">
        <div class="cell first w140"><?php echo $form->labelEx($model,'language'); ?></div>
        <div class="cell">
            <?php echo $form->dropDownList($model,'language', Yii::app()->params['languages'], array('onchange' => "changeLanguage()")); ?>
        </div>
    </div>
    <?php endif;?>

    <?php if(extension_loaded('gd')): ?>
    <div class="row clearfix" style="margin-bottom:0">
        <div class="cell first w140"><?php echo $form->labelEx($model,'verifyCode'); ?></div>
        <div class="cell"><?php echo $form->textField($model,'verifyCode', array('class'=>'text', 'size' => 4)); ?></div>
        <div class="cell"><?php $this->widget('CCaptcha', array('showRefreshButton'=>false)); ?></div>
    </div>
    <!--div class="hint">Please enter the letters as they are shown in the image above.
    <br/>Letters are not case-sensitive.</div-->
    <?php endif; ?>


    <div class="row rememberMe clearfix">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
    </div>

    <div class="row center clearfix">
        <?php echo CHtml::submitButton(Yii::t('Global', 'Login'), array('id' => 'login-button', 'class' => 'button')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->