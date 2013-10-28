<?php
/* 
 
 */
class KannelController extends SBaseController
{
    public $layout='main';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
        $this->layout="detail";

        $model = $this->loadModel();
        
		$this->render('view',array(
			'model'=>$model,
		));
	}

    public function actionCreate()
    {
        $this->layout="detail";
        
        if($model=Kannel::model()->find())  //Neu da co thong tin tin thi chuyen sang cap nhat
            $this->redirect ("/kannel/update");

        $model = new Kannel();
        
        if(isset($_POST['Kannel']))
		{
			$model->attributes = $_POST['Kannel'];

            $checkUrl = true;
            /*
            // check url exist
            $ch = curl_init("http://".$model->host);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
            curl_setopt($ch,CURLOPT_POSTFIELDS, "username=".$model->username."&password=".$model->password);

            //execute 
            $checkUrl = curl_exec($ch);

            if(!$checkUrl)
            {
                $model->addErrors(array("host" => "url không hợp lệ"));
            }
            */
            if($model->validate() && $checkUrl)
            {
                if($model->save())
                    $this->redirect(array('view'));
            }

            //close connection
            curl_close($ch);
		}

		$this->render('create',array(
			'model'=>$model
		));
        
    }

    public function actionUpdate()
	{
		$model = $this->loadModel();
       
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kannel']))
		{
			$model->attributes = $_POST['Kannel'];
            
            $checkUrl = true;
            /*
            // check url exist
            $ch = curl_init("http://".$model->host.":13013");
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
            curl_setopt($ch,CURLOPT_POSTFIELDS, "username=".$model->username."&password=".$model->password);

            //execute
            $checkUrl = curl_exec($ch);
            if(!$checkUrl)
            {
                $model->addErrors(array("host" => "url không hợp lệ"));
            }
            */
            if($model->validate() && $checkUrl)
            {
                //if($model->updateAll($model->attributes))
                $model->updateAll($model->attributes);
                $this->redirect(array('view'));
            }

            //close connection
            curl_close($ch);
		}

        $this->layout="detail";
		$this->render('update',array(
			'model'=>$model
		));
	}

    public function loadModel()
	{
		if($this->_model===null)
		{
            $this->_model = Kannel::model()->find();
            if($this->_model===null)
            {
				// redirect to create new
                $this->redirect("/kannel/create");
            }
		}
		return $this->_model;
	}
}
?>
