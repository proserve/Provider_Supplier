<?php

/**
 * This is the model class for table "{{evaluator}}".
 *
 * The followings are the available columns in table '{{evaluator}}':
 * @property string $id
 * @property string $fist_name
 * @property string $last_name
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Criteria[] $psCriterias
 */
class Evaluator extends CActiveRecord {

    public $username;
    public $assignedCategorie;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{evaluator}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // will receive user inputs.
        return array(
            array('fist_name, last_name, function', 'length', 'max' => 256),
            array('username', 'unique', 'message' => 'this username already exsists'),
            array('username, psswd_hash', 'required'),
          //  array('psswd_hash', 'passwordStrengthOk'),
            array('username, psswd_hash', 'length', 'max' => 64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, fist_name, last_name ,username ,function , username, psswd_hash, assignedCategorie', 'safe', 'on' => 'search'),
        );
    }

    public function passwordStrengthOk($attribute, $params) {
// default to true
        $valid = true;
// at least one number
        $valid = $valid && preg_match
                        ('/.*[\d].*/', $this->$attribute);
// at least one non-word character
        $valid = $valid && preg_match
                        ('/.*[\W].*/', $this->$attribute);
// at least one capital letter
        $valid = $valid && preg_match
                        ('/.*[A-Z].*/', $this->$attribute);
        if (!$valid)
            $this->addError($attribute, "Does not meet password 
            requirements.");
        return $valid;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'psCriterias' => array(self::MANY_MANY, 'Criteria', '{{evaluator_criteria}}(evaluator_id, criteria_id)'),
            'psCategorie' => array(self::MANY_MANY, 'Categorie', '{{evaluator_categorie}}(evaluator_id, categorie_id)'),
            'assCategories' => array(self::HAS_MANY, 'EvaluatorCategorie', 'evaluator_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'fist_name' => Yii::t('app1', 'First name'),
            'last_name' => Yii::t('app1', 'Last name'),
            'function' => Yii::t('app1', 'Function'),
            'username' => Yii::t('app1', 'Username'),
            'psswd_hash' => Yii::t('app1', 'Password'),
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
    public function getRelatedCategories() {
        $out = CHtml::listData($this->psCategorie, 'id', 'name');
        return implode(', ', $out);
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('fist_name', $this->fist_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('function', $this->function, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('psswd_hash', $this->psswd_hash, true);
        $criteria->with = array('assCategories');
        $criteria->together = TRUE;
        $criteria->compare('categorie_id', $this->assignedCategorie, true);
        return new CActiveDataProvider($this->find('username=:username', array(':username' => Yii::app()->user->name)), array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'assignedCategorie' => array(
                        'asc' => 'categorie_id',
                        'desc' => 'categorie_id DESC',
                    ), '*')),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Evaluator the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            // Classname => path to Class
            'ActiveRecordLogableBehavior' =>
            'application.behaviors.ActiveRecordLogableBehavior',
        );
    }

    public function getIDFromUsername() {
        $var = $this->find('username=:username', array(':username' => Yii::app()->user->name));
        return $var['id'];
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->psswd_hash = crypt($this->psswd_hash);
            return true;
        }
        return false;
    }

    public function check($value) {
        $new_hash = crypt($value, $this->psswd_hash);
        if ($new_hash == $this->psswd_hash) {
            return true;
        }
        return false;
    }

    public function getEvaluatorOptions() {
        return CHtml::listData($this->model()->findAll(), 'id', 'username');
    }

    public function getIDByUsername($username) {
        $var = $this->find('username=:username', array(':username' => $username));
        return $var['id'];
    }

    public function getEvaluatorUpdateOptions() {
        $tab = Convoquer::model()->findAll('appel_offre_id=:offre', array(':offre' => Yii::app()->user->getState('appelOffre')));
        $result = array();
        $i = 0;
        foreach ($tab as $value) {
            $result[$i] = Evaluator::model()->findByPk($value['evaluator_id'])->username;
            $i++;
        }
        return $result;
    }

    public function getEvaluatorUpdateOption() {
        $tab = Convoquer::model()->findAll('appel_offre_id=:offre', array(':offre' => Yii::app()->user->getState('appelOffre')));
        $result = array();
        $i = 0;
        foreach ($tab as $value) {
            $result[$i] = Evaluator::model()->findByPk($value['evaluator_id']);
            $i++;
        }
        return $result;
    }

    public function getRestedEvalautor() {
        $result = array();
        $sql = 'select `username` from `ps_evaluator` ev 
        where (ev.id not in (select `evaluator_id` from `ps_convoquer` where `appel_offre_id`=:app_id) )';
        $cmd = Yii::app()->db->createCommand($sql);
        $cmdRe = $cmd->queryAll(TRUE, array(':app_id' => Yii::app()->user->getState('appelOffre')));
        foreach ($cmdRe as $key => $value) {
            $result[$key] = $value['username'];
        }
        return $result;
    }

    /*
     * return categories for the current evaluator
     */

    public function getCategoriesForEva($username) {
        return Evaluator::model()->getIDByUsername(Yii::app()->user->name)->psCategorie;
    }

    /*
     * this function return evaluator list that can evaluate an criteria  
     */
    /*  public function getEvaluatorListForCriteria($criteriaID){
      $tab = array();$i=0;
      $va = CriteriaCategorie::model()->findAll('criteria_id=:crit', array(':crit'=>$criteriaID));
      foreach($va as $key=>$value){
      $tab[$key] = $value->categorie_id;
      }
      $vv = EvaluatorCategorie::model()->findAll('categorie_id in ('.implode(',', $tab).')');
      $result = array();
      foreach ($vv as $value) {
      $result[$i] = $value->evaluator_id;
      $i++;
      }
      return $result;
      } */
}