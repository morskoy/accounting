<?php

class TableEditorsController extends Controller
{
    /**
    * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
    * using two-column layout. See 'protected/views/layouts/column2.php'.
    */
    public $layout='//layouts/column1';

    public $_model;
    //public $_delete;

    /**
    * @return array action filters
    */
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
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view','create','update','setFlash'),
                'roles'=>array('editor'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'roles'=>array('administrator'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actions() {
        return array(
            'update' => 'application.controllers.actions.UpdateAction',
            'delete' => array(
                'class' => 'application.controllers.actions.DeleteAction',
                'messages' => array(
                    'success' => 'Mix successfully created',
                ),
            ),
            'create' => 'application.controllers.actions.CreateAction',

        );
    }

    public function setFlash( $key, $value, $defaultValue = null )
    {
        Yii::app()->user->setFlash( $key, $value, $defaultValue );
    }


    /**
    * Show all editors for user.
    * @param integer $user_id the ID of the user
    */
    public function actionView($userId) {

        $userId = (int) $userId;
        if ($userId != 0) {
            $criteria = new CDbCriteria;
            $criteria->condition = "user_id = :user_id";
            $criteria->params = array(":user_id"=>$userId);
            //$criteria->with = array('user');
            $criteria->order = 'date_start DESC';
            $dataProvider = new CActiveDataProvider('TableEditors',array(
                'criteria' => $criteria,
                'pagination'=>array(
                    'pageSize'=>50,
                ),
            ));

            $userName = User::model()->findbyPk($userId)->FullFio;

            $this->render('view',array(
                'dataProvider' => $dataProvider,
                'userName' => $userName,
                'userId' => $userId,
            ));

        } else
            throw new CHttpException(404,'Необходимо передать ID пользователя.');
    }

    /**
    * Creates a new model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    */
    public function actionCreate($userId)
    {
        $userId = (int) $userId;

        $model=new TableEditors();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['TableEditors']))
        {
            $model->attributes=$_POST['TableEditors'];
            $model->user_id = $userId;
            if($model->save()){
                //$this->redirect(array('view','userId'=>$model->id));

                if( Yii::app()->request->isAjaxRequest )
                {
                    // Stop jQuery from re-initialization
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;

                    echo CJSON::encode( array(
                        'status' => 'success',
                        'content' => 'ModelName successfully created',
                    ));
                    exit;
                }
                else $this->redirect(array('view','userId'=>$userId));

            }

        }

        if( Yii::app()->request->isAjaxRequest )
        {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;

            echo CJSON::encode( array(
                'status' => 'failure',
                'content' => $this->renderPartial( '_form', array(
                        'model' => $model ), true, true ),
            ));
            exit;
        }
        else
            $this->render( 'create', array( 'model' => $model ) );


    }


    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id the ID of the model to be updated
     */

    public function actionUpdate()
    {
        $model = $this->loadModel();
        if( isset( $_POST['TableEditors'] ) )
        {
            $model->attributes = $_POST['TableEditors'];
            if( $model->save() )
            {
                if( Yii::app()->request->isAjaxRequest )
                {
                    // Stop jQuery from re-initialization
                    Yii::app()->clientScript->scriptMap['jquery.js'] = false;

                    echo CJSON::encode( array(
                        'status' => 'success',
                        'content' => 'TableEditors successfully updated',
                    ));
                    exit;
                }
                else
                    $userId = TableEditors::model()->findbyPk($model->id)->user_id;
                    $this->redirect( array( 'view', 'userId' => $userId ) );
            }
        }

        if( Yii::app()->request->isAjaxRequest )
        {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;

            echo CJSON::encode( array(
                'status' => 'failure',
                'content' => $this->renderPartial( '_form', array(
                        'model' => $model ), true, true ),
            ));
            exit;
        }
        else
            $this->render( 'update', array( 'model' => $model ) );
    }

    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
     */


    public function actionDelete()
    {
        $model = $this->loadModel();
        if( Yii::app()->request->isAjaxRequest )
        {

            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;

            if( isset( $_POST['deleteConfirmed'] ) && $_POST['deleteConfirmed'] == true )
            {

                $model->delete();
                echo CJSON::encode( array(
                    'status' => 'success',
                    'content' => 'Удаление выполнено',
                ));
                Yii::app()->end();

            }
            else if( isset( $_POST['action'] ) )
            {
                echo CJSON::encode( array(
                    'status' => 'canceled',
                    'content' => 'Deletion canceled',
                ));
                Yii::app()->end();
            }
            else
            {

                echo CJSON::encode( array(
                    'status' => 'failure',
                    'content' => $this->renderPartial( '_delete', array(
                            'model' => $model ), true, true ),
                ));
                exit;
            }
        }

        /**
        else
        {
            if( isset( $_POST['deleteConfirmed'] ) )
            {

                if ($model->delete()){
                    echo "ok";
                    exit;
                }
                $this->redirect( array( 'admin' ) );
            }
            else if( isset( $_POST['denyDelete'] ) )
                $this->redirect( array( 'view', 'id' => $model->id ) );
            else
                $this->render( 'delete', array( 'model' => $model ) );
        }
         */
    }


    /**
    * Lists all models.
    */
    public function actionIndex()
    {
    $dataProvider=new CActiveDataProvider('TableEditors');
    $this->render('index',array(
    'dataProvider'=>$dataProvider,
    ));
    }

    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
    $model=new TableEditors('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['TableEditors']))
    $model->attributes=$_GET['TableEditors'];

    $this->render('admin',array(
    'model'=>$model,
    ));
    }

    /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer the ID of the model to be loaded

    public function loadModel($id)
    {
    $model=TableEditors::model()->findByPk($id);
    if($model===null)
    throw new CHttpException(404,'The requested page does not exist.');
    return $model;
    }


    public function actionDelete()
    {
        if(Yii::app()->request->isPostRequest)
        {
            $this->loadModel()->delete();

            if(!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400,
                Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
    }
     */

    public function loadModel()
    {
        if( $this->_model === null )
        {
            if( isset( $_GET['id'] ) )
                $this->_model = TableEditors::model()->findByPk( (int) $_GET['id'] );
            if( $this->_model === null )
                throw new CHttpException( 404, 'The requested page does not exist.' );
        }
        return $this->_model;
    }



    /**
    * Performs the AJAX validation.
    * @param CModel the model to be validated
    */
    protected function performAjaxValidation($model)
    {
    if(isset($_POST['ajax']) && $_POST['ajax']==='table-editors-form')
    {
    echo CActiveForm::validate($model);
    Yii::app()->end();
    }
    }
}
