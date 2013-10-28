<?php $this->beginContent('application.views.admin.layouts.main'); ?>
<div class="container">
    <div id="content" class="clearfix">
        <div id="sidebar">
            <h3 class="rounded-top-5">&nbsp;<?php //echo Yii::t('BackEnd', $this->moduleName) ?></h3>
            <?php
                $this->widget('application.widgets.admin.Sidebar', array(
                    'items'=>  Backend::getModuleSlideBar('Setting', '/srbac'),
                    'htmlOptions'=>array('class'=>'rounded-bottom-5'),
                ));
            ?>
        </div>
        <div id="main">
            <?php echo $content; ?>
        </div>
    </div><!-- content -->
</div>
<?php $this->endContent(); ?>