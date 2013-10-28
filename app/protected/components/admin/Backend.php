<?php
Class Backend
{
    /**
     *
     * get main menu items array
     * @return array
     */
    public static function getMainMenu() {
        $allMenu = array(
            //array('label'=>Yii::t('BackEnd','Home'), 'url'=>array('/site/index')),
            //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
            //array('label'=>'Contact', 'url'=>array('/site/contact')),

            //Phân hệ quản lý CP
            'Cp' => array('label'=>Yii::t('BackEnd','Cps management'),
                'controllers' => array('cp', 'cpGroup'),
                'url'=>array(Yii::app()->request->baseUrl.'/cp/index'), 'visible'=>UserAccess::checkAccess('cpIndex')
            ),            

            //Phân hệ quản lý service
            'Service' => array('label'=>Yii::t('BackEnd','Sms service'),
                'subs'=>array(
                    '/smsService/index' => array('label'=>Yii::t('BackEnd','Sms service'), 'url'=>array(Yii::app()->request->baseUrl.'/smsService/index'), 'visible'=>UserAccess::checkAccess('smsServiceIndex')),
                    //'/spamSms/index' => array('label'=>Yii::t('BackEnd','Spam service'), 'url'=>'#', 'visible'=>UserAccess::checkAccess('spamSmsServiceIndex')),
                    '/sendSms/index' => array('label'=>Yii::t('BackEnd','Send Sms'), 'url'=>array(Yii::app()->request->baseUrl.'/sendSms/index'), 'visible'=>UserAccess::checkAccess('sendSmsIndex')),
                    '/sendSms/testSendMo' => array('label'=>Yii::t('BackEnd','Send Mo'), 'url'=>array(Yii::app()->request->baseUrl.'/sendSms/testSendMo'), 'visible'=>UserAccess::checkAccess('sendSmsTestSendMo')),
                ),
                'controllers' => array('smsService', 'sendSms')
            ),

            //Phân hệ báo cáo thống kê
            'Statistics' => array('label'=>Yii::t('BackEnd','Statistics & Reports'),
                'subs'=>array(
                    '/mt/index' => array('label'=>Yii::t('BackEnd','MT sms'), 'url'=>array(Yii::app()->request->baseUrl.'/mt/index'), 'visible'=>UserAccess::checkAccess('mtIndex')),
                    '/mo/index' => array('label'=>Yii::t('BackEnd','MO sms'), 'url'=>array(Yii::app()->request->baseUrl.'/mo/index'), 'visible'=>UserAccess::checkAccess('moIndex')),
                ),
                'controllers' => array('mo', 'mt')
            ),
            
            //Quản trị hệ thống
            'Setting' => array('label'=>Yii::t('BackEnd','System settings'),
                'subs'=>array(
                    '/adminUser/index' => array('label'=>Yii::t('BackEnd','Admin users'), 'url'=>array(Yii::app()->request->baseUrl.'/adminUser/index'), 'visible'=>UserAccess::checkAccess('adminUserIndex')),
                    '/srbac' => array('label'=>Yii::t('BackEnd','Grant Permission'), 'url'=>array(Yii::app()->request->baseUrl.'/srbac'), 'visible'=>UserAccess::checkAccess('srbac')),
                    '/config/index' => array('label'=>Yii::t('BackEnd','System config'), 'url'=>array(Yii::app()->request->baseUrl.'/config/index'), 'visible'=>UserAccess::checkAccess('configIndex')),
                    '/kannel/view' => array('label'=>Yii::t('BackEnd','Kannel config'), 'url'=>array(Yii::app()->request->baseUrl.'/kannel/view'), 'visible'=>UserAccess::checkAccess('kannelIndex')),
                    '/smsc/index' => array('label'=>Yii::t('BackEnd','Smsc'), 'url'=>array(Yii::app()->request->baseUrl.'/smsc/index'), 'visible'=>UserAccess::checkAccess('smscIndex')),
                ),
                'controllers' => array('adminUser', 'config', 'srbac', 'authitem', 'kannel', 'smsc' )
            )

        );

        self::rebuildArray($allMenu);
        return $allMenu;
    }

    public static function rebuildArray(&$allMenu)
    {
        foreach ($allMenu as $k=>$menu)
        {
            if(isset($menu['subs'])&& is_array($menu['subs']))
            {
                foreach ($menu['subs'] as $ksub=>$item)
                {
                    if(isset($item['visible']) && !$item['visible'])
                    {
                        unset ($menu['subs'][$ksub]);
                    }
                }
            }

            //Assign url in subs item to Parent
            if(isset($menu['url']))
            {
                $allMenu[$k]['url'] = $menu['url'];
            }
            elseif(count($menu['subs']))
            {
                //var_dump(array_values($menu['subs']));array_shift(array_values($menu['subs'])); die;
                $item = array_values($menu['subs']);
                $allMenu[$k]['url'] = $item['0']['url'];
            }
            else
            {
                unset ($allMenu[$k]);
            }

            //recursive function
//            if(isset($menu['subs']['subs'])&& is_array($menu['subs']['subs']))
//            {
//                self::rebuildArray($menu['subs']);
//            }
        }

    }
    public static function getModuleSlideBar($module, $activeItem, $level2 = '') {
        $mainMenu = self::getMainMenu();
        if($level2)
        {
            $slideBar = $mainMenu[$module]['subs'][$level2]['subs'];
        }
        else
        {
            $slideBar = $mainMenu[$module]['subs'];
        }
        if(!isset($slideBar[$activeItem])) return array();

        $slideBar[$activeItem]['url'] = "#";
        $slideBar[$activeItem]['class'] = 'active';
        return $slideBar;
    }

    /**
     *
     * get product status array, displayed independent by language
     * @return array
     */
    public static function getProductStatusList() {
        return Product::getStatusTitleArray();
    }

    public static function getAllColor(){
        $criteria = new CDbCriteria;
        $criteria->select = 'distinct(name)';
        $items = self::model()->findAll($criteria);
        $colors = array(''=>'');
        foreach($items as $item)
        {
            $colors[$item->name] = $item->name;
        }
        return $colors;
    }

    

    public static function optionsSlideBar($optionId = null)
    {
        $options = ProductOption::model()->findAll(array('order'=>'status'));
        $slideBar = array();
        $index = 0;
        $activedId = 0;

        if($options)
        {
            foreach($options  as $option)
            {
                $class = '';
                if(($optionId == null) && !$index)
                {
                    $activedId = $option->id;
                    $class = 'active';
                }
                elseif($option->id == $optionId) $class = 'active';
                elseif($option->status == ProductOption::STATUS_DISABLED) $class = 'disable';

                array_push(
                    $slideBar,
                    array('label'=>$option->name, 'name'=>"product-option{$option->id}-info", 'url'=>Yii::app()->request->baseUrl.'/productOptionItem/index.html?optionId='.$option->id, 'class' => $class)
                );
                $index++;
            }

            array_push(
                $slideBar,
                array('label'=>Yii::t('BackEnd', 'Manage'), 'name'=>"product-option-manage", 'url'=>Yii::app()->request->baseUrl.'/productOption/admin.html', 'class'=>'sButton')
            );
        }

        return array(
            'slideBar' => $slideBar,
            'activedId' => $activedId,
        );
    }
}
?>
