<?php

/**
 * This is the model class for table "{{evaluator_criteria}}".
 *
 * The followings are the available columns in table '{{evaluator_criteria}}':
 * @property string $evaluator_id
 * 
 * @property string $criteria_id
 * @property integer $mark
 */
class EvaluatorCriteria extends CActiveRecord {

    public $evaluator_search;
    public $criteria_search;
    public $otherMark;
    public $markSum;
    public $active;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{evaluator_criteria}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('evaluator_id, criteria_id, mark, appel_offre_id', 'required'),
            array('mark', 'numerical', 'min' => 0, 'max' => 9,
                'tooSmall' => 'the mark must not be  lesse then 0',
                'tooBig' => 'the mark must  be  lesse then 9'),
            array('*', 'compositeUniqueKeysValidator'),
            array('evaluator_id, criteria_id, appel_offre_id', 'length', 'max' => 10),
            // @todo Please remove those attributes that should not be searched.
            array('evaluator_id, criteria_id, mark, evaluator_search, criteria_search, otherMark, appel_offre_id, markSum, active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'criteria' => array(self::BELONGS_TO, 'Criteria', 'criteria_id'),
            'evaluator' => array(self::BELONGS_TO, 'Evaluator', 'evaluator_id'),
            'appelOffre' => array(self::BELONGS_TO, 'AppelOffre', 'appel_offre_id'),
                //  'markSum'=> array(self::STAT, 'Criteria', 'criteria_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'evaluator_id' => Yii::t('app', 'Evaluator'),
            'criteria_id' => Yii::t('app', 'Criteria'),
            'mark' => Yii::t('app1', 'Mark'),
            'appel_offre_id' => Yii::t('app', 'Appel Offre'),
        );
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
    public function getCriteriaPercent() {
        if (EvaluatorCriteria::model()->getCriteriasMarksSum() != 0) {
            return round($this->getSumForCriteria($this->criteria) * 100 / EvaluatorCriteria::model()->getCriteriasMarksSum(), 2);
        } else {
            return 0;
        }
    }
    public function getActivationStatus(){
        $var = Criteria::model()->getCriteriasListForEvaluator() ;
        return (isset($var[$this->criteria->id]) ? 'Enalbe': 'disable' );
    }

    public function search() {
        $criteria = new CDbCriteria;
        $sql_active = '(select )';
        $criteria->condition = 'evaluator.username = \'' . Yii::app()->user->id . '\'and appelOffre.id=\'' . Yii::app()->user->getState('appelOffre') . '\'';
        $criteria->compare('mark', $this->mark);
        $criteria->with = array('criteria', 'evaluator', 'appelOffre');
        $criteria->together = true;
        //$criteria->addSearchCondition($column, $keyword)
        $criteria->addSearchCondition('criteria.name', $this->criteria_search, TRUE);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'criteria_search' => array(
                        'asc' => 'criteria.name',
                        'desc' => 'criteria.name DESC'
                    ),
                    'evaluator_search' => array(
                        'asc' => 'evaluator.last_name',
                        'desc' => 'evaluator.last_name DESC'
                    ), '*',
                ),
            ),
        ));
    }
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return EvaluatorCriteria the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    function getMarkOptions() {
        return $markOptions = array(
            0 => Yii::t('app2', 'Selecte one from here'),
            1 => '1- '.Yii::t('app2', 'Not importante'),
            3 => '3- '.Yii::t('app2', 'Lower importance'),
            5 => '5- '.Yii::t('app2', 'Mediume importance'),
            7 => '7- '.Yii::t('app2', 'Important'),
            9 => '9- '.Yii::t('app2', 'Very Importante'),
        );
    }

    public function behaviors() {
        return array(
            'ActiveRecordLogableBehavior' => 'application.behaviors.ActiveRecordLogableBehavior',
            'ECompositeUniqueKeyValidatable' => array(
                'class' => 'application.behaviors.ECompositeUniqueKeyValidatable',
                'uniqueKeys' => array(
                    'attributes' => 'criteria_id, evaluator_id, appel_offre_id',
                    'errorMessage' => Yii::t('app', 'you have already evaluate this criteria')
                )
            ),
        );
    }
    /*
     * get marks sum per criteria
     */
    
    public function getMarkSumOffre($criteriaId, $offre) {
        $evaluators = Convoquer::model()->findAll(array(
            'select' => 'evaluator_id',
            'distinct' => true,
            'condition' => 'appel_offre_id=' . $offre,
        ));
        $evaluat = array();$i=0;
        foreach ($evaluators as $value) {
            $evaluat[$i] = $value->evaluator_id;
            $i++;
        }
        $evaluat = implode(',', $evaluat);
        $evaluatorsNum = count($evaluators);
        $condition = 'appel_offre_id=' . $offre . ' and criteria_id = ' . $criteriaId
                .' and evaluator_id in ('.$evaluat.')';
                ; // AND EVALUATOR IN
        $evaluations = EvaluatorCriteria::model()->findAll($condition);
        $result = 0;
        $count = 0;
        foreach ($evaluations as $value) {
            $result += $value->mark;
            $count++;
        }
        if ($count != $evaluatorsNum && $count != 0) {
            $result = ($result / $count) * $evaluatorsNum;
        }
        /* $sql ='SELECT ROUND( SUM( mark ) , 2 ) as total
          FROM ps_evaluator_criteria
          WHERE (
          criteria_id =:criteria
          AND appel_offre_id =:offre
          AND evaluator_id
          IN (

          SELECT evaluator_id
          FROM ps_criteria_categorie cc
          JOIN ps_evaluator_categorie ec ON ( cc.categorie_id = ec.categorie_id
          AND criteria_id =:criteria )
          )
          )';
          $cmd = Yii::app()->db->createCommand($sql);
          $result = $cmd->queryAll(true, array(
          ':offre'=>  Yii::app()->user->getState('appelOffre'),
          ':criteria' => $criteriaID,
          )); */
        return round($result, 2);
    }

    /*
     * get marks sum per criteria
     */

    public function getMarksSum($criteriaID) {
        return $this->getMarkSumOffre($criteriaID, Yii::app()->user->getState('appelOffre'));
    }

    /*
     * this function return a table containe mark sum in values and criteria_id in keys
     */
    public function getMarkSumTableOffre($offre){
        $criterias = Concern::model()->findAll('appel_offre_id=:offre', array(
            ':offre'=>  $offre));
        $result = array();
        foreach ($criterias as $value) {
            $result[$value->criteria_id]= $this->getMarkSumOffre($value->criteria_id, $offre);
        }
        return $result;
    }
    public function getMarkSumTable(){
        $criterias = Concern::model()->findAll('appel_offre_id=:offre', array(
            ':offre'=>  Yii::app()->user->getState('appelOffre')));
        $result = array();
        foreach ($criterias as $value) {
            $result[$value->criteria_id]= $this->getMarksSum($value->criteria_id);
        }
        return $result;
    }
    
    

    /*
     * get All critarias marks sum for the current opened appel offre 
     */

    function getCriteriasMarksSum() {
        return array_sum($this->getMarkSumTable());
    }

    /*
     * get mark sum for one criteria in the current appel offre
     */

    /*function getSumForCriteria($criteria) {
        $sql = 'SELECT round(sum( mark ), 2) AS `sum`
                FROM `ps_evaluator_criteria` `cri`
                WHERE( `cri`.`criteria_id`=:criteria AND `cri`.`appel_offre_id`=:offre 
                AND cri.criteria_id
                IN (

                SELECT co.criteria_id
                FROM ps_concern co
                WHERE co.appel_offre_id =:offre
                )
                )';
        $kav = Yii::app()->db->createCommand($sql)->queryAll(True, array(
            ':offre' => Yii::app()->user->getState('appelOffre'),
            ':criteria' => $criteria->id,
        ));
        return $kav[0]['sum'];
    }*/

    function scopes() {
        if (isset($_GET['id'])) {
            return array(
                'idCriteria' => array(
                    'condition' => 'criteria_id=' . $_GET['id']['criteria_id'],
                ),
            );
        }
    }

    public function primaryKey() {
        return array('evaluator_id', 'criteria_id', 'appel_offre_id');
    }

    public function compositeUniqueKeysValidator() {
        $this->validateCompositeUniqueKeys();
    }

    function getEvaluationsCountForCurrentUser() {
        return (int) $this->countByAttributes(array(
                    'evaluator_id' => Evaluator::model()->find('username=:username', array(':username' => Yii::app()->user->name))->id
        ));
    }

}
