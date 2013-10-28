<?php
/**
 * Sidebar class file.
 *
 * @author Tungnv <tungnv83@gmail.com>
 */

/**
 * Sidbar displays a multi-level menu using nested HTML lists.
 *
 *
 * The following example shows how to use Sidebar:
 * <pre>
 * $this->widget('application.widgets.Sidebar', array(
 *     'items'=>array(
 *         array('label'=>'Basic Information', 'name'=>'basic-info', 'rel'=>'attr-group1')),
 *         array('label'=>'More Information',  'name'=>'more-info', 'rel'=>'attr-group2', 'url'=>array('site/index')),
 *     ),
 * ));
 * </pre>
 * @since 1.1
 */
class Sidebar extends CWidget {
    /**
     * @var array list of menu items.
     */
    public $items=array();

    /**
     * @var array HTML attributes for the menu's root container tag
     */
    public $htmlOptions=array();

    /**
     * Initializes the menu widget.
     * This method mainly normalizes the {@link items} property.
     * If this method is overridden, make sure the parent implementation is invoked.
     */
    public function init() {
        $this->htmlOptions['id']=$this->getId();

        $this->registerClientScript();
        parent::init();
    }


    protected function registerClientScript() {
        $cs=Yii::app()->clientScript;
        $cs->registerCssFile(Yii::app()->request->baseUrl."/css/admin/gridview.css");
        $cs->registerCssFile(Yii::app()->request->baseUrl."/css/admin/sidebar.css");
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile(Yii::app()->request->baseUrl."/js/admin/sidebar.js");
    }


    /**
     * Calls {@link renderMenu} to render the menu.
     */
    public function run() {
        $cs=Yii::app()->clientScript;
        $cs->registerScript('slidebar',
                'formCreator.buildSideBar(\''.$this->getId().'\')',
                CClientScript::POS_HEAD);
        $this->renderMenu($this->items);
    }

    /**
     * Renders the menu items.
     * @param array menu items. Each menu item will be an array with at least two elements: 'label' and 'active'.
     * It may have three other optional elements: 'items', 'linkOptions' and 'itemOptions'.
     */
    protected function renderMenu($items) {
        if(count($items)) {
            echo CHtml::openTag('ul',$this->htmlOptions)."\n";
            $this->renderMenuItems($items);
            echo CHtml::closeTag('ul');
        }
    }

    /**
     * Recursively renders the menu items.
     * @param array the menu items to be rendered recursively
     */
    protected function renderMenuItems($items) {
        
        foreach($items as $item) {
            if(isset($item['visible']) && !$item['visible']) continue;
            
            $onclick = (isset($item['onclick']) && $item['onclick']) ? $item['onclick']:'';
            //$error = $item['error']?'<img src="'.Yii::app()->request->baseUrl.'/css/admin/images/icon_error.png"/>':'';
            $show = isset($item['error']) ? 'show' : '';
            echo CHtml::openTag('li');
            echo CHtml::openTag('a',array('id'=>$item['name'], 'name'=>$item['name'], 'href'=>CHtml::normalizeUrl(isset($item['url']) ? $item['url'] : "#"), 'rel' => $item['rel'], 'class'=>(isset($item['class']))?$item['class']:'', 'onclick'=>$onclick));
            $span = <<<EOD
<span>
   <span class="changed"></span>
   <span class="error $show"></span>
                    {$item['label']}
</span>
EOD;
            echo $span;
            echo Chtml::closeTag("a");

            echo CHtml::closeTag('li')."\n";
        }
    }
}