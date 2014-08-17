<?php

class ProviderCompareController extends Controller {

    public $layout = '//layouts/column1';

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
                'actions' => array('indexResult', 'index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('result', 'matrixTabs', 'create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionAdmin() {
        $model = new ProviderCompare('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ProviderCompare'])) {
            $model->attributes = $_GET['ProviderCompare'];
        }
        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionDelete() {
        $model = ProviderCompare::model()->findByPk(array(
            'provider_a_id' => $_GET['id']['provider_a_id'],
            'provider_b_id' => $_GET['id']['provider_b_id'],
            'criteria_id' => $_GET['id']['criteria_id'],
            'appel_offre_id' => $_GET['id']['appel_offre_id'],
        ));
// we only allow deletion via POST request
        if ($model->delete()) {
            Yii::app()->user->setFlash('success', '<strong>Well done!</strong>. you delete comparaison');
        }

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('otherAdmin'));
    }

    public function actionMatrixTabs() {
        $criteriaID = 4;
        $criteria = Criteria::model()->getSelectedCriteria();
        $tab = array();
        $tab[0] = array('label' => Yii::t('app3', 'Final result'),
            'content' => $this->renderPartial('result', NULL, TRUE), 'active' => true);
        $i = 1;

        foreach ($criteria as $k => $value) {
            $tab[$i] = array('label' => Criteria::model()->findByPK($k)->name,
                'content' => $this->renderPartial('matrix', array('criteriaID' => $k), TRUE));
            $i++;
        }

        $this->render('matrixTabs', array(
            'criteriaID' => $criteriaID,
            'tab' => $tab,
        ));
    }

    public function actionResult() {
        $this->render('Result');
    }

    public function actionIndexResult() {
        $this->render('indexResult');
    }

    public function actions() {
        return array(
            'create' => 'application.controllers.providerCompare.CompareAction',
            'update' => 'application.controllers.providerCompare.CompareAction',
        );
    }

}