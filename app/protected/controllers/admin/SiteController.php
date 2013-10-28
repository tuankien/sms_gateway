<?php

class SiteController extends Controller {
    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'backColor'=>0xFFFFFF,
                        'minLength'=>5,
                        'maxLength'=>5,
                        'fontFile'=>_APP_PATH_.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.'ttf'.DIRECTORY_SEPARATOR.'arial.ttf',
                ),
                // page action renders "static" pages stored under 'protected/views/site/pages'
                // They can be accessed via: index.php?r=site/page&view=FileName
                'page'=>array(
                        'class'=>'CViewAction',
                ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() 
    {
        $this->redirect(Yii::app()->request->baseUrl.'/adminUser/'.Yii::app()->user->id.'.html');
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model=new ContactForm;
        if(isset($_POST['ContactForm'])) {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate()) {
                $headers="From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm'])) {
            $model->attributes=$_POST['LoginForm'];

            if((Yii::app()->params['languages']) && array_key_exists($model->language, Yii::app()->params['languages']))
            {
                $language = $model->language;
                Yii::app()->setLanguage($language);
                Yii::app()->session['_lang'] = $language;
            }

            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
            {
                $this->redirect(Yii::app()->request->baseUrl.'/adminUser/'.Yii::app()->user->id.'.html');
                /*
                if(!Yii::app()->user->returnUrl)
                    $this->redirect(Yii::app()->request->baseUrl);
                else
                    $this->redirect(Yii::app()->user->returnUrl);
                */
            }
        }
        // display the login form
        $this->layout = "login";
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        // update user login status
        $user = AdminUser::model()->updateByPk(Yii::app()->user->getId(), array('status'=>AdminUser::STATUS_ACTIVED));
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * change language
     */
    public function actionChangeLanguage() {
        $lang = $_REQUEST['lang'];
        if(isset(Yii::app()->params['languages'][$lang])) {
            Yii::app()->setLanguage($lang);
            Yii::app()->session['_lang'] = $lang;
        }

        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionGetstates(){
        if(Yii::app()->request->isAjaxRequest && isset($_GET['city']))
        {
            $city = $_GET['city'];
            $data = Common::dumpAllStatesToArray($city);
            echo json_encode($data);
        }
        Yii::app()->end();
    }

    /**
     * Fills the JS tree on an AJAX request.
     * Should receive parent node ID in $_GET['root'],
     *  with 'source' when there is no parent.
     */
    public function actionAjaxFillTree()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            exit();
        }
        $parentId = "NULL";
        if (isset($_GET['root'])) {
            $parentId = (int) $_GET['root'];
        }
        $req = Yii::app()->db->createCommand(
            "SELECT pc.id, pc.name AS text, pc.parent IS NOT NULL AS hasChildren "
            . "FROM product_category AS pc "
            . "WHERE pc.parent <=> $parentId "
            . "GROUP BY pc.id ORDER BY pc.name ASC"
        );
        $children = $req->queryAll();
        $tree = str_replace(
            '"hasChildren":"0"',
            '"hasChildren":false',
            CTreeView::saveDataAsJson($children)
        );


        echo $tree;
        exit();
    }
}