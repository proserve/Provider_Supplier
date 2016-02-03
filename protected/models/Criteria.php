<?php

/**
 * This is the model class for table "{{criteria}}".
 *
 * The followings are the available columns in table '{{criteria}}':
 * @property string $id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Evaluator[] $psEvaluators
 */
class Criteria extends CActiveRecord {

    public $markSum;
    public $assignedCategorie;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{criteria}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name', 'unique', 'message' => 'this name already exsists'),
            array('name', 'length', 'max' => 255),
            array('description', 'length', 'max' => 256),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, description, markSum, assignedCategorie', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'psEvaluators' => array(self::MANY_MANY, 'Evaluator', '{{evaluator_criteria}}(criteria_id, evaluator_id)'),
            'psEvaluatorCriteria' => array(self::HAS_MANY, 'EvaluatorCriteria', 'criteria_id'),
            /* this relation return the sum of criterias marks for the current appel offre*/
            'psEvaluatorCriteriaCount' => array(self::STAT, 'EvaluatorCriteria', 'criteria_id', 
                'select' => 'sum(mark)','condition' => 'appel_offre_id='.Yii::app()->user->getState('appelOffre')),
            'markSumR' => array(self::STAT, 'Evaluator', '{{evaluator_criteria}}(criteria_id, evaluator_id)'),
            'psCategorie' => array(self::MANY_MANY, 'Categorie', '{{criteria_categorie}}(criteria_id, categorie_id)'),
            'assCategories' =>array(self::HAS_MANY,'CriteriaCategorie','criteria_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' =>Yii::t('app', 'ID') ,
            'name' =>Yii::t('app1', 'Name') ,
            'description' =>Yii::t('app', 'Description') ,
        );
    }

    public function getRelatedCategories(){
        $out = CHtml::listData($this->psCategorie, 'id', 'name');
        return implode(',', $out);
    }
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    /*
     * this function return a prepered string for an sql qury
     */
    public function costumIpmolde($tab){
        foreach ($tab as $key=> $value) {
            $tab[$key] = '\''.$value.'\'';
        }
        return implode(',', $tab);
    }
/*    public function getEva(){
        return 'and evaluator_id in (select evaluator_id from ps_criteria_categorie cc  join ps_evaluator_categorie ec on '
        . '(cc.categorie_id = ec.categorie_id and criteria_id =criteria_id))' ;
    }
    public function search() {
      // $k = '(select t.id from t)'
        $sql_sum = '(select ROUND(sum(mark),1) from ps_evaluator_criteria where (criteria_id =t.id and appel_offre_id ='
                .Yii::app()->user->getState('appelOffre').$this->getEva().') )';//and criteria_id in ('.$var.')
        $criteria = new CDbCriteria;
        $criteria->select =  array(
            '*',
            $sql_sum. " as markSum" ,
        );
        $criteria->condition = '`t`.`name` in ('.$this->costumIpmolde( $this->getCriteriaUpdateOptions()).')';
        $criteria->compare($sql_sum, $this->markSum);
        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        
        $criteria->with = array('assCategories',);
        $criteria->together = TRUE;
        $criteria->compare('categorie_id', $this->assignedCategorie, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            
            'sort' => array(
                'attributes' => array(
                    'assignedCategorie' => array(
                        'asc' => 'categorie_id',
                        'desc' => 'categorie_id DESC',
                    ),
                    'markSum' => array(
                        'asc' => 'markSum ASC ',
                        'desc' => 'markSum DESC  '
                    )
                    ,
                    '*')),
           
        ));
    }*/
    public function search2() {
        $criteria = new CDbCriteria;
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        
        $criteria->with = array('assCategories',);
        $criteria->together = TRUE;
        $criteria->compare('categorie_id', $this->assignedCategorie, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            
            'sort' => array(
                'attributes' => array(
                    'assignedCategorie' => array(
                        'asc' => 'categorie_id',
                        'desc' => 'categorie_id DESC',
                    ),
                    '*')),
           
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Criteria the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    

    public function getCriteriaOption() {
        return CHtml::listData($this->findAll(), 'id', 'name');
    }
    
    public function getSelectedCriteriaOptions(){
      //  return CHtml::listData($this->getSelectedCriteria(), 'id', 'id');
        $rab = $this->getSelectedCriteria();
       //$rii = $this->findAll();
        $result = array();$i= 0; 
        foreach ($rab as $key=> $value) {
            $result[$i] =array('name' => $this->findByPk($key)->name ,'id' => $key );
            $i++;
        }
        return CHtml::listData($result, 'id', 'name');
    }

    /*
     * RETURN THE SELECT CRITERIA FOR THE CURRENT APPEL OFFRE
     */
    public function getSelectedCriteriaOffre($offre) {
    $numberOfSelectedCriteria = 5;
    $criteria = EvaluatorCriteria::model()->getMarkSumTableOffre($offre);
    arsort($criteria, SORT_NUMERIC);
    $result = array();$index = 0;
    foreach ($criteria as $key=> $value) {
        $result[$key] = $value;
        if($index == $numberOfSelectedCriteria-1)            break;
        $index++;
    }
    return $result;
    }
    public function getSelectedCriteria() {
    
    return $this->getSelectedCriteriaOffre(Yii::app()->user->getState('appelOffre'));
    }
    /*
     * return a table of selected criteria id
     */
    public function getSelectedCriteriaIDTable(){
        $selected = Criteria::model()->getSelectedCriteria();
        $select = array();
        foreach ($selected as $key => $value) {
            $select[$key] = $key;
        }// get a table that containe id of th selected criterias
        return $select;
    }
    /*
     * this function return the sum of the selected criterias in the appel offre 
     */

    public function getSelectedCriteriaSum() {
        return array_sum($this->getSelectedCriteria());
    }

    public function behaviors() {
        return array(
            'ActiveRecordLogableBehavior' => 'application.behaviors.ActiveRecordLogableBehavior',
        );
    }

    /*public function getCriteriasNotEvaluatedByUsername() {
        $sql = 'SELECT name FROM `ps_criteria`
where id NOT IN (select `criteria_id` from `ps_evaluator_criteria` 
where(`evaluator_id`=\'' . Evaluator::model()->getIDFromUsername() . '\'))';
        return Yii::app()->db->createCommand($sql)->queryAll();
    }*/
    public function getRestedCriteria(){
        $result = array();
        $sql = 'select `name` from `ps_criteria` ev 
        where (ev.id not in (select `criteria_id` from `ps_concern` where `appel_offre_id`=:app_id) )';
        $cmd = Yii::app()->db->createCommand($sql);
        $cmdRe = $cmd->queryAll(TRUE, array(':app_id'=>  Yii::app()->user->getState('appelOffre')));
        foreach ($cmdRe as $key=>$value){
            $result[$key] = $value['name'];
        }
        return $result;
    }
    /*
     * return the seleceted criterias models for the activated project
     */
    public function getCriteriaUpdateOption(){
        $tab = Concern::model()->findAll('appel_offre_id=:offre', array(':offre'=>  Yii::app()->user->getState('appelOffre')));
        $result = array();$i =0 ;
        foreach ($tab as $value) {
            $result[$i] = Criteria::model()->findByPk($value['criteria_id']);
            $i++;
        }
        
        return $result;
    }
    /*
     * return the seleceted criterias names for the activated project
     */
    public function getCriteriaUpdateOptions(){
        $tab = Concern::model()->findAll('appel_offre_id=:offre', array(':offre'=>  Yii::app()->user->getState('appelOffre')));
        $result = array();$i =0 ;
        foreach ($tab as $value) {
            $result[$i] = Criteria::model()->findByPk($value['criteria_id'])->name;
            $i++;
        }
        return $result;
    }
    public function getIDByName($name){
        return $this->find('name=:name', array(':name'=>$name))->id;
    }
    /*
     * return criterias for an evaluator in the activated project
     */
    
    public function getCriteriasForEvaluator($username){
        $eva_id = Evaluator::model()->getIDByUsername($username);
         $sql = 'SELECT `id`, `name`
                FROM `ps_criteria` `crit`
                WHERE `id`
                IN (
                SELECT `criteria_id` AS `crit`
                FROM `ps_criteria_categorie` `cri_cat`
                WHERE `cri_cat`.`categorie_id`
                IN (
                SELECT `categorie_id` AS `cate`
                FROM `ps_evaluator_categorie` `eva_cat`
                WHERE `eva_cat`.`evaluator_id` =:eva_id
                )
                )
                AND `id`
                IN (
                SELECT `criteria_id` AS `crit`
                FROM `ps_concern` `cons`
                WHERE `cons`.`appel_offre_id` =:offre_id
                )';
         $cmd = Yii::app()->db->createCommand($sql);
         $result = $cmd->queryAll(TRUE, array(':eva_id'=>$eva_id, ':offre_id' => Yii::app()->user->getState('appelOffre')));
         return $result;
         
    }
    public function getCriteriasListForEvaluator(){
        return CHtml::listData($this->findAll(), 'id', 'name');
      //  return CHtml::listData($this->getCriteriasForEvaluator(Yii::app()->user->name), 'id', 'name');
    }
    /*
     * get the number of criteriass available for this user 
     */
    public function getCountAvailbaleCriteria(){
        return count($this->getCriteriasForEvaluator(Yii::app()->user->name));
    }
    /*
     * get number of evualted criterias in this project
     */
    public function getCountEvaluatedCriterias($username){
        $crit = array_flip(Criteria::model()->getCriteriasListForEvaluator());
        $crite = implode(',', $crit);
        if($crite ==''){
            return 0;
        }else{
             $sql ='SELECT count( * ) AS `count`
        FROM `ps_evaluator_criteria` `ec`
        WHERE `evaluator_id` =:eva_id
        AND `appel_offre_id` =:offre_id
        AND `ec`.`criteria_id` in ('. $crite .')';//select `o`.`criteria_id` from `ps_concern` `o` where `o`.`appel_offre_id`=:offre_id
        $cmd = Yii::app()->db->createCommand($sql);
        $eva_id = Evaluator::model()->getIDByUsername($username);
        $result = $cmd->queryAll(TRUE, array(':eva_id'=>$eva_id, ':offre_id' => Yii::app()->user->getState('appelOffre')));
        return $result[0]['count'];
        }
       
    }
    public function getCriteriasNotEvaluatedByUsername(){
        $sql = 'SELECT `id` , `name`
                FROM `ps_criteria` `crit`
                WHERE `id`
                IN (
                SELECT `criteria_id` AS `crit`
                FROM `ps_criteria_categorie` `cri_cat`
                WHERE `cri_cat`.`categorie_id`
                IN (
                SELECT `categorie_id` AS `cate`
                FROM `ps_evaluator_categorie` `eva_cat`
                WHERE `eva_cat`.`evaluator_id` =:eva_id
                )
                )
                AND `id`
                IN (
                SELECT `criteria_id` AS `crit`
                FROM `ps_concern` `cons`
                WHERE `cons`.`appel_offre_id` =:offre_id
                )
                AND `id` NOT
                IN (
                SELECT `criteria_id` AS `count`
                FROM `ps_evaluator_criteria`
                WHERE `evaluator_id` =:eva_id
                AND `appel_offre_id` =:offre_id
                )';
        $eva_id = Evaluator::model()->getIDByUsername(Yii::app()->user->name);
        $cmd = Yii::app()->db->createCommand($sql);
        $result = $cmd->queryAll(TRUE, array(':eva_id'=>$eva_id, ':offre_id' => Yii::app()->user->getState('appelOffre')));
        return $result;
    }

}

