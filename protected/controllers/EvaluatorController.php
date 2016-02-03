<?php

class EvaluatorController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'view'),
                'users' => array('@'),
            ),
            array(
                'action' => array('create'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('adminEvaluation', 'create', 'admin', 'delete'),
                'users' => array('root'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Evaluator;
        $categorie = new EvaluatorCategorie;

// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Evaluator'])) {
            $model->attributes = $_POST['Evaluator'];
            if( isset($_POST['EvaluatorCategorie'])){
            if ($model->save()) {
                $sql = 'insert into  `ps_evaluator_categorie` (`categorie_id`, `evaluator_id`) values ';

                $categorie_idTab = $_POST['EvaluatorCategorie']['categorie_id'];
                $sql .= '(\'' . $categorie_idTab[0] . '\',\'' . $model->id . '\')';
                for ($i = 1; $i < count($categorie_idTab); $i++) {
                    $sql .= ', (\'' . $categorie_idTab[$i] . '\',\'' . $model->id . '\')';
                }
                 Yii::app()->user->setFlash('success', Yii::t('app', 'Well done') );

            }}else{
                 Yii::app()->user->setFlash('error', Yii::t('app', 'You have an error (my be categorie)') );
            }
        }

        $this->render('create', array(
            'model' => $model,
            'categorie' => $categorie,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->psswd_hash = '';
        $categorie = new EvaluatorCategorie;
        $categorieTab = EvaluatorCategorie::model()->findAll('evaluator_id=:evaluator_id', array(':evaluator_id' => $id));
        $cateTable = array();
        for ($i = 0; $i < count($categorieTab); $i++) {
            $cateTable[$i] = $categorieTab[$i]['categorie_id'];
        }
        $categorie->categorie_id = $cateTable;
// Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Evaluator'])) {
            $model->attributes = $_POST['Evaluator'];
            if (isset($_POST['EvaluatorCategorie'])) {
                if ($model->save()) {
                    $sql = 'DELETE FROM  `ps_evaluator_categorie` WHERE  `evaluator_id`=' . $id;
                    $commande = Yii::app()->db->createCommand($sql);
                    $commande->execute();

                    $categorie->unsetAttributes();
                    $sql = 'insert into  `ps_evaluator_categorie` (`categorie_id`, `evaluator_id`) values ';

                    $categorie_idTab = $_POST['EvaluatorCategorie']['categorie_id'];
                    $sql .= '(\'' . $categorie_idTab[0] . '\',\'' . $model->id . '\')';
                    for ($i = 1; $i < count($categorie_idTab); $i++) {
                        $sql .= ', (\'' . $categorie_idTab[$i] . '\',\'' . $model->id . '\')';
                    }
                    Yii::app()->db->createCommand($sql)->execute();  Yii::app()->user->setFlash('success', Yii::t('app', 'Well done') );

            }}else{
                 Yii::app()->user->setFlash('error', Yii::t('app', 'You have an error (my be categorie)') );
            
            }
        }

        $this->render('update', array(
            'model' => $model,
            'categorie' => $categorie,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        //    if (Yii::app()->request->isPostRequest) {
// we only allow deletion via POST request
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        //  } else
        //    throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Evaluator');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Evaluator('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Evaluator']))
            $model->attributes = $_GET['Evaluator'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Evaluator::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'evaluator-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
