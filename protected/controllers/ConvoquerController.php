<?php

class ConvoquerController extends Controller {

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
            /*array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),*/
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('add', 'list'),
                'users' => array('root'),
            ),/*
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'create', 'update'),
                'users' => array('root'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),*/
        );
    }



    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        $model = new Convoquer;
        
        if(isset($_POST['Convoquer'])){
            $appel_id = Yii::app()->user->getState('appelOffre');
            $model->appel_offre_id = $appel_id;
            $sql = 'delete from  `ps_convoquer` (`appel_offre_id`, `evaluator_id`) values ';
            
            $evaluator_idTab = explode(',',  $_POST['Convoquer']['evaluator_id']);
            for ($i=0;$i<count($evaluator_idTab); $i++) {
                $tes =Evaluator::model()->getIDByUsername($evaluator_idTab[$i]);
                $model->evaluator_id = $tes ;
                $sql = 'delete  from  `ps_convoquer` where (`appel_offre_id`='.$appel_id.' and `evaluator_id` ='.
                        $tes.')' ; 
               /// if($model->validate('evaluator_id')){
                Yii::app ()->db->createCommand ($sql)->execute();
                Yii::app()->user->setFlash('success','<strong>'.Yii::t('app','Well done').' ! </strong>.'); 
                //}
            }
             $model->evaluator_id ='';
            // $this->redirect('list');
                
            
        }
        if(count(Evaluator::model()->getEvaluatorUpdateOptions())==0){
          $this->render('UpdateEr');  
        }else
        $this->render('update', array(
            'model'=> $model,
        ));
    }

 
    public function actionAdd(){
        $model = new Convoquer;
        
        if(isset($_POST['Convoquer'])){
            $appel_id = Yii::app()->user->getState('appelOffre');
            $sql = 'insert into  `ps_convoquer` (`appel_offre_id`, `evaluator_id`) values ';
            $model->appel_offre_id = $appel_id;
            $evaluator_idTab = explode(',',  $_POST['Convoquer']['evaluator_id']);
            $var=Evaluator::model()->getIDByUsername($evaluator_idTab[0]);
            $model->evaluator_id = $var ;
            $bool =1;
            $sql .= '(\'' . $appel_id . '\',\'' .$var . '\')';
            if(!$model->validate()){
            
            $bool = -1; 
            }
            for ($i=1;$i<count($evaluator_idTab); $i++) {
                $var=Evaluator::model()->getIDByUsername($evaluator_idTab[$i]);
            $model->evaluator_id = $var ;
            if(!$model->validate()){
            
            $bool = -1; 
            }
            
                $sql .= ',(\'' . $appel_id . '\',\'' . $var . '\')';
            
                               
            }
            if($bool == 1 ){
                Yii::app()->user->setFlash('success','<strong>'.Yii::t('app','Well done').' ! </strong>.'); 
                Yii::app ()->db->createCommand ($sql)->execute(); 
              //  $this->redirect('list');
            }
            $model->evaluator_id ='';
                
        }
        if(count(Evaluator::model()->getRestedEvalautor())==0){
          $this->render('addEr');  
        }else
        $this->render('add', array(
            'model'=> $model,
        ));
    }
    public function actionList(){
        $this->render('list');
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = AppelOffre::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t ('app', 'The requested page does not exist.'));
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'appel-offre-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
