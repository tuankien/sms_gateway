<?php $this->beginContent('application.views.admin.layouts.main'); ?>
<div class="container">
    <div id="content" class="clearfix">
        <div id="sidebar">
            <h3 class="rounded-top-5">
                <?php if(!empty($this->sidebarTop)):?>
                    <?php if($this->sidebarTop['link'] != "#"): ?>
                        <a href="<?php echo $this->sidebarTop['link'] ?>"><?php echo $this->sidebarTop['label'] ?>&nbsp;<img src="<?php echo Yii::app()->request->baseUrl?>/data/images/icon_up.gif"/></a>
                    <?php else:?>
                        <a href="#"><?php echo $this->sidebarTop['label'] ?></a>
                    <?php endif;?>
                <?php else: ?>
                    &nbsp;
                <?php endif; ?>
            </h3>
            <?php
                $this->widget('application.widgets.admin.Sidebar', array(
                    'items'=>$this->slidebar,
                    'htmlOptions'=>array('class'=>'rounded-bottom-5'),
                ));
            ?>
        </div>
        <div id="main">
            <!-- content header -->
            <?php if($this->title || $this->menu):?>
            <div class="content-header">
                <table>
                <tr>
                    <td><p class="title"><?php echo Yii::t('BackEnd', $this->title) ?></p></td>
                    <td>
                        <?php $this->widget('zii.widgets.CMenu', array(
                            'items'=>$this->menu,
                            'htmlOptions'=>array('class'=>'operations'),
                        ));?>
                    </td>
                </tr>
                </table>
            </div>
            <?php endif;?>
            <!-- end content header -->

            <div class="content-body">
                <?php echo $content; ?>
            </div>
        </div>
    </div><!-- content -->
</div>
<?php $this->endContent(); ?>