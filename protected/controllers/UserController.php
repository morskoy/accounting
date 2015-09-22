<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

    public function accessRules()  {

        return array(
            array('allow',
                'actions'=>array('spravka','birthday','index','view','getDepartment'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('update','create'),
                'roles'=>array('editor'),
            ),
            array('allow',
                'actions'=>array('delete','changepass','disable','enable'),
                'roles'=>array('administrator'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }


    /**
     * Выводит данные по пользователям, доступен гостям
     */

    public  function actionSpravka() {

        $model = new User('search');
        $model->unsetAttributes();
        if(isset($_GET['User'])) $model->attributes=$_GET['User'];
        $this->render('spravka',array(
            'model'=>$model,
        ));
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

        $this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

       // if(Yii::app()->user->checkAccess('administrator')){
            $model=new User('insert');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['User']))
            {
                $model->attributes=$_POST['User'];
                //echo "<pre>";
                //print_r($model->attributes);
                //echo "</pre>";
                //exit;
                //$model->password = 'password';
                if($model->save())
                    $this->redirect(array('index'));
            }

            $this->render('create',array(
                'model'=>$model,
            ));
      //  }

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        //if(Yii::app()->user->checkAccess('administrator')){
            $model=$this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);


            if(isset($_POST['User']))
            {
                $model->setScenario('update');
                $model->attributes=$_POST['User'];
                if($model->save()){

                    $this->redirect(array('view','id'=>$model->id));
                }

            }

            $this->render('update',array(
                'model'=>$model,
            ));
       // }

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        //if(Yii::app()->user->checkAccess('administrator')){
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	    //}
    }

    public function actionDisable($id) {

        User::model()->updateByPk($id, array('active' => 0));
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));


    }

    public function actionEnable($id) {

        User::model()->updateByPk($id, array('active' => 1));
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));


    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model = new User('search');
        $model->unsetAttributes();
        if(isset($_GET['User'])) $model->attributes=$_GET['User'];
        $this->render('index',array(
            'model'=>$model,
        ));

	}

    /**
     * Изменение пароля пользователя
     */

    public function actionChangePass($id) {

        $model=$this->loadModel($id);
        $model->scenario = 'changepass';

        if(isset($_POST['User']))
        {

            $model->attributes = $_POST['User'];

            if($model->validate())  {

                $model->password = md5($model->newPassword);

                if ($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('changepass',array(
            'model'=>$model,
        ));


    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		//if(Yii::app()->user->checkAccess('administrator')){
			$model=new User('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['User']))
				$model->attributes=$_GET['User'];
	
			$this->render('admin',array(
				'model'=>$model,
			));
		//}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
        if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

        //$modelEditors = TableEditors::model()->find('user_id=:user_id', array(':user_id'=> $id), array('order'=>'date_start DESC '));
        //$model->editor= $modelEditors->editor_id;

        /** передаём в форму нужные атрибуты */
        //$modelAttributes = TableAttributes::model()->findAll('user_id=:user_id', array(':user_id'=> $id), array('order'=>'date_start DESC '));
        //foreach ($modelAttributes as $modelAttribute) {
        //    if ($modelAttribute->attribute == 1) $model->hired_date_start = $modelAttribute->date_start;
        //    elseif ($modelAttribute->attribute == 2) $model->fired_date_start = $modelAttribute->date_start;
        //}
        //echo $model->hired_date_start;
        //echo '<br>'.$model->fired_date_start;
        //exit;

        return $model;
	}

    public function actiongetDepartment()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {

            $models = Department::model()->suggestDepartment($_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->department,
                    'id_post' => $m->id,
                    //'id_department' => $m->id_department,
                    //'id_sub_department' => $m->id_sub_department,
                    //'department' => $m->department,
                    //'sub_department' => $m->sub_department,
                );

            echo CJSON::encode($result);
        }
    }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


}
