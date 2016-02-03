<?php

class AppelOffreController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('result', 'publish', 'index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('close', 'open'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('rate', 'admin', 'delete', 'create', 'update'),
                'users' => array('root'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionResult($number)
    {
        $model = AppelOffre::model()->find('number=:num', array(':num' => $number));
        $this->render('result', array('model' => $model));
    }

    /*
     * @return string a list of posts
     * @soap
     */
    public function getAppelOffre()
    {
        return 'test';
    }

    public function actionPublish()
    {
        $model = new AppelOffre;

        if (isset($_POST['AppelOffre'])) {
            $model = $this->loadModel($_POST['AppelOffre']['id']);
            $model->publish = 1;
            if ($model->save()) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Well done'));

            }

        }
        $this->render('publish', array('model' => $model));

    }

    public function actions()
    {
        return array(
            'service' => array(
                'class' => 'CWebServiceAction',
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new AppelOffre;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['AppelOffre'])) {
            $model->attributes = $_POST['AppelOffre'];
            if ($model->save())
                $this->redirect(array('admin'));
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['AppelOffre'])) {
            $model->attributes = $_POST['AppelOffre'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionRate()
    {
        $model = $this->loadModel(Yii::app()->user->getState('appelOffre'));
        if (isset($_POST['AppelOffre'])) {
            $model->technique_rate = $_POST['AppelOffre']['technique_rate'];
            $model->finance_rate = $_POST['AppelOffre']['finance_rate'];
            if ($model->technique_rate + $model->finance_rate != 100) {
                Yii::app()->user->setFlash('error', Yii::t('app2', 'Sum of technical rate and finance rate not equal to 100'));
            } else if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('rate', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new AppelOffre('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AppelOffre']))
            $model->attributes = $_GET['AppelOffre'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionOpen()
    {
        $model = new AppelOffre;
        $active = 0;
        if (isset($_GET['AppelOffre'])) {
            $active = $_GET['AppelOffre']['id'];
            Yii::app()->user->setFlash('success', '<strong>' . Yii::t('app', 'Well done') . ' ! </strong>.' .
                Yii::t('app', 'you open') . ' ' .
                AppelOffre::model()->findByPk($active)->titre);
        }
        Yii::app()->user->setState('appelOffre', $active);
        $this->render('open', array(
            'model' => $model,
        ));
    }

    public function actionClose()
    {
        Yii::app()->user->setState('appelOffre', 0);
        $this->redirect(array('open'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = AppelOffre::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'appel-offre-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
