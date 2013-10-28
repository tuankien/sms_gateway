<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'application.views.layouts.column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='application.views.admin.layouts.column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public $slidebar=array();

    public $sidebarTop = array();
    public $moduleName="";
    public $title="";
    
    public $YII_CSRF_TOKEN = "";


    /*
     * init function
     */
    public function init() {
        if (!isset(Yii::app()->session['_lang']))
        {
            Yii::app()->session['_lang'] = Yii::app()->params['defaultLanguage'];
        }

        Yii::app()->language = Yii::app()->session['_lang'];

        if(Yii::app()->request->enableCsrfValidation)
        {
            $this->YII_CSRF_TOKEN = Yii::app()->request->getCsrfToken();
        }
        
        return parent::init();
    }

    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			),
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'controllers'=>array('site'),
                'actions'=>array('login','captcha','changeLanguage'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
}