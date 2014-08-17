<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CompareAction extends CAction {

    public function run() {
        $model = $this->constructModel();
        $this->performAjaxValidation($model);
        if (isset($_POST['ProviderCompare'])) {
            $this->assignMark($model);
            $this->assignComp($model);
            if(ProviderCompare::model()->exists('provider_a_id=:provider_a_id and provider_b_id=:provider_b_id and criteria_id=:criteria_id '
                    . 'and appel_offre_id=:offre ', 
                array(':provider_a_id'=>$model->provider_b_id, ':provider_b_id'=>$model->provider_a_id, ':criteria_id'=>$model->criteria_id, 
                    ':offre'=> $model->appel_offre_id))){
                Yii::app()->user->setFlash('error', '<strong>Error !</strong> your already compare '.$model->provider_a_id.
                        ' with '. $model->provider_b_id.' this tow providers .');
              
            }else if ($model->save()){
                Yii::app()->user->setFlash('success', '<strong>Well done!</strong>.');
            }
        }
        $this->getController()->render($this->createPageToRender(), array('model' => $model));
    }

    public function assignMark($model) {
        $markTable = ProviderCompare::model()->getMarkOptions();
        if ($_POST['ProviderCompare']['mark'] != 0) {
            $model->mark = $_POST['ProviderCompare']['mark'];
        } elseif ($_POST['ProviderCompare']['otherMark'] != '') {
            $model->mark = $_POST['ProviderCompare']['otherMark'];
        }
    }
    
    public function assignComp($model) {
        if ($model->mark == 1) {
            $model->comp = '=';
        } else if ($_POST['ProviderCompare']['comp'] == 1) {
            $model->comp = '>';
        } else if ($_POST['ProviderCompare']['comp'] == 0) {
            $model->comp = '<';
        }
    }
    public function constructModel(){
        
        if(isset($_GET['id']['provider_a_id']) && isset($_GET['id']['provider_b_id']) && isset($_GET['id']['criteria_id']) && isset($_GET['id']['appel_offre_id']) ){
            $model = ProviderCompare::model()->findByPk(array(
                'provider_a_id'=>$_GET['id']['provider_a_id'], 
                'provider_b_id'=>$_GET['id']['provider_b_id'],
                'criteria_id'=>$_GET['id']['criteria_id'],
                 'appel_offre_id' => $_GET['id']['appel_offre_id'],
                    ));
            if($model->comp==='>'){
            $model->comp = 0 ;
        }else if($model->comp==='<'){
            $model->comp = 1 ;
        }
        }  else {
            $model = new ProviderCompare('create');
             $model->comp = 0 ;
            if (isset($_POST['ProviderCompare'])) {
             $model->provider_a_id = $_POST['ProviderCompare']['provider_a_id'];
            $model->provider_b_id = $_POST['ProviderCompare']['provider_b_id'];
            $model->criteria_id = $_POST['ProviderCompare']['criteria_id'];
            $model->appel_offre_id = Yii::app()->user->getState('appelOffre');
            }
        }
        return $model;
    }
    public function createPageToRender(){
        $page = '';
        if(isset($_GET['id']['provider_a_id']) && isset($_GET['id']['criteria_id'])){
            $page = 'update';
        }else {
            $page = 'compare';
        }
        return $page;
    }    
    
    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'provider-compare-_form-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}