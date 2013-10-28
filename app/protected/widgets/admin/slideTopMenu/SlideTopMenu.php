<?php
/**
 * MainMenu Widget
 *
 * @author tungnv
 */
class SlideTopMenu extends CWidget {

    private $cssFile = 'css/admin/slideTopMenu.css';
    private $jsFile = 'js/admin/slideTopMenu.js';
    private $downImg = 'data/images/blank.gif';
    private $rightImg = 'data/images/blank.gif';
    
    private $cssIE7hack = '<!--[if lte IE 7]>
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
<![endif]-->
';

    public $items = array();
    public $id = '';

    public function init()
    {
        if(empty($this->id)){
            $this->id = 'ltjqsm'.rand(1, 1000);
        }

        // client files
        $this->cssFile  = Yii::app()->request->baseUrl."/".$this->cssFile;
        $this->jsFile   = Yii::app()->request->baseUrl."/".$this->jsFile;
        $this->downImg  = Yii::app()->request->baseUrl."/".$this->downImg;
        $this->rightImg   = Yii::app()->request->baseUrl."/".$this->rightImg;

        $this->registerClientScript();
        parent::init();
    }

    protected function registerClientScript()
    {
        $cs=Yii::app()->clientScript;
        
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile($this->cssFile);
        // not sure if it is needed
        //$cs->registerCss('jqueryslidemenu.ie7fix', $this->cssIE7hack);
        $cs->registerScriptFile($this->jsFile);
        // images used in menu folder (down and right arrows)
        $cs->registerScript('jqueryslidemenu.images',
            'var arrowimages={down:[\'downarrowclass\', \''.$this->downImg.'\', 23], right:[\'rightarrowclass\', \''.$this->rightImg.'\']}',
            CClientScript::POS_HEAD);
    }

    private function setupItems($items)
    {
        $ritems = array();

        $controller=$this->controller;
        $action = $controller->action;
        
        foreach($items as $item)
		{
			if(isset($item['visible']) && !$item['visible']) continue;
			$item2=array();
			$item2['label']=$item['label'];
			if(is_array($item['url']))
				$item2['url']=$controller->createUrl($item['url'][0]);
			else
				$item2['url']=Yii::app()->request->baseUrl.$item['url'];
			//$pattern=isset($item['pattern'])?$item['pattern']:$item['controllers'];
			$item2['active']=$this->isActive($item,$controller->id,$action->id);
            if (isset($item['subs']) && is_array($item['subs'])){
                $item2['subs'] = $this->setupItems($item['subs']);
            }
			$ritems[]=$item2;
		}

        return $ritems;
    }

    public function run()
    {
        $items = $this->setupItems($this->items);
        Yii::app()->clientScript->registerScript('jqueryslidemenu.'.$this->id, 'jqueryslidemenu.buildmenu(\''.$this->id.'\', arrowimages)', 
                CClientScript::POS_HEAD);

		$this->render('view',array('id' => $this->id, 'items'=>$items));
    }

    protected function isActive($item,$controllerID,$actionID)
	{
//        echo "<br/>";
//        print_r($controllers);
//        echo "-----".$controllerID;
//        echo "<br/>";
        
        if( isset($item['subs']) && is_array($item['subs']) && array_key_exists("/$controllerID/$actionID", $item['subs'])) return true;
        elseif(isset($item['controllers']) && is_array($item['controllers'])) return in_array($controllerID, $item['controllers']);
        return false;
	}

}
?>
