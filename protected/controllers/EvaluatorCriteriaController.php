<?php
class EvaluatorCriteriaController extends Controller {

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin','evaluation','alignement','lineChartView','peiChartView','charts','otherAdmin','create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array( 'admin', 'delete'),
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
   /* public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }*/

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new EvaluatorCriteria;
        

// Uncomment the following line if AJAX validation is needed
 $this->performAjaxValidation($model);

        if (isset($_POST['EvaluatorCriteria'])) {
            $model->criteria_id = $_POST['EvaluatorCriteria']['criteria_id'];
            $eva = Evaluator::model()->find('username=:username', array(':username' => Yii::app()->user->name));
            $model->evaluator_id=  $eva['id'];
            $model->appel_offre_id = Yii::app()->user->getState('appelOffre');
            //$markTable = EvaluatorCriteria::model()->getMarkOptions();
            if($_POST['EvaluatorCriteria']['mark'] != 0){
               $model->mark = $_POST['EvaluatorCriteria']['mark'];
            }
            elseif ($_POST['EvaluatorCriteria']['otherMark']!='') {
            $model->mark =$_POST['EvaluatorCriteria']['otherMark'];
              }
              
            if($model->save()){
            $name = Criteria::model()->findByPk($model->criteria_id)['name'];
            Yii::app()->user->setFlash('success','<strong>Well done!</strong>. you give '.$model->mark.' for the '.$name.'.');
            }  
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    public function actionAdmin() {
        $model = new EvaluatorCriteria('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['EvaluatorCriteria']))
            $model->attributes = $_GET['EvaluatorCriteria'];
        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
      public function actionUpdate() {
        //$eva = Evaluator::model()->find('username=:username', array(':username' => Yii::app()->user->name));
        $model = EvaluatorCriteria::model()->findByPK(array(
                                'evaluator_id' => $_GET['id']['evaluator_id'],
                                'criteria_id' => $_GET['id']['criteria_id'],
                                'appel_offre_id' => Yii::app()->user->getState('appelOffre'),
            ));
        $this->performAjaxValidation($model);
       
        if (isset($_POST['EvaluatorCriteria'])) {
            $markTable = EvaluatorCriteria::model()->getMarkOptions();
            if($_POST['EvaluatorCriteria']['mark'] != 0){
               $model->mark = $_POST['EvaluatorCriteria']['mark'];
            }
            elseif ($_POST['EvaluatorCriteria']['otherMark']!='') {
            $model->mark =$_POST['EvaluatorCriteria']['otherMark'];
        }
            if($model->save()){
            $name = Criteria::model()->findByPk($model->criteria_id)['name'];
            Yii::app()->user->setFlash('success','<strong>Well done!</strong>. you update '.$name.' criteria to '.$model->mark.'.');
            
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }
    public function actionDelete() {
        $model = EvaluatorCriteria::model()->idCriteria()->find('evaluator_id=:evaluator_id',array(':evaluator_id'=>$_GET['id']['evaluator_id']));
// we only allow deletion via POST request
                    $name = Criteria::model()->findByPk($model->criteria_id)['name'];

           if($model->delete()){
            Yii::app()->user->setFlash('success','<strong>Well done!</strong>. you delete your Evaluation for the '.$name.' criteria to .');
            }

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('otherAdmin'));
    }
    public function actionOtherAdmin() {
     $var = EvaluatorCriteria::model()->getModelByUsername();
    $idEva =Evaluator::model()->getIDFromUsername();
        $this->render('otherAdmin', array(
            'var'=>$var,
            'idEva'=>$idEva
        ));
    }
    
    public function actionCharts() {
       
        $this->render('charts');
    }
    public function actionPeiChartView() {
        
        $this->render('peiChartView');
    }
    public function actionLineChartView() {
        $model = new EvaluatorCriteria('search');
       
        $this->render('lineChartView', array(
            'model' => $model,
        ));
    }
    /*public function actionAlignement() {
        $this->render('alignement');
    }*/
    public function actionEvaluation() {
   
        $this->render('evaluation');
    }
    public function actionEvaluationcreate() {
   
        $this->render('evaluationcreate');
    }
     protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'provider-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
