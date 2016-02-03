<?php

/**
 * This is the model class for table "{{appel_offre}}".
 *
 * The followings are the available columns in table '{{appel_offre}}':
 * @property string $id
 * @property string $reference
 * @property integer $number
 * @property string $titre
 * @property string $dateDebut
 * @property string $dateFin
 * @property string $description
 * @property string $condition
 * @property string $type
 * @property boolean $publish
 *
 * The followings are the available model relations:
 * @property Criteria[] $psCriterias
 * @property Evaluator[] $psEvaluators
 * @property Provider[] $psProviders
 */
class AppelOffre extends CActiveRecord
{
    public $active;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{appel_offre}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, reference, titre', 'required'),
            array('number', 'numerical', 'integerOnly' => true),
            array('finance_rate, technique_rate', 'numerical', 'integerOnly' => true),
            array('reference', 'length', 'max' => 256),
            array('type', 'length', 'max' => 512),
            array('titre', 'length', 'max' => 255),
            array('dateDebut, dateFin, description, condition, finance_rate, technique_rate', 'safe'),
            array('publish', 'boolean'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, reference, number, titre, dateDebut,type, dateFin, description, condition, finance_rate, technique_rate, publish', 'safe', 'on' => 'search'),
        );
    }

    public function readyOffreValidation($attribute, $params)
    {

        if (!ProviderCompare::model()->readyOffre($this->id))
            $this->addError($attribute, 'vous ne pouvez pas publier cette offre appel d\'Offre (elle n\'est pas complète) !');
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'psCriterias' => array(self::MANY_MANY, 'Criteria', '{{concern}}(appel_offre_id, criteria_id)'),
            'psEvaluators' => array(self::MANY_MANY, 'Evaluator', '{{convoquer}}(appel_offre_id, evaluator_id)'),
            'psProviders' => array(self::MANY_MANY, 'Provider', '{{participe}}(appel_offre_id, provider_id)'),
            'psConvoquer' => array(self::HAS_MANY, 'Convoquer', 'appel_offre_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'reference' => Yii::t('app', 'Reference'),
            'number' => Yii::t('app', 'Number'),
            'titre' => Yii::t('app', 'Title'),
            'dateDebut' => Yii::t('app', 'Strat date'),
            'dateFin' => Yii::t('app', 'End date'),
            'description' => Yii::t('app', 'Description'),
            'condition' => Yii::t('app', 'Conditions'),
            'type' => Yii::t('app', 'Type'),
            'finance_rate' => Yii::t('app2', 'Finance rate') . ' %',
            'technique_rate' => Yii::t('app2', 'Technical rate') . ' %',
            'publish' => Yii::t('app3', 'Publish'),
        );
    }

    public function behaviors()
    {
        return array(
            // Classname => path to Class
            'ActiveRecordLogableBehavior' =>
                'application.behaviors.ActiveRecordLogableBehavior',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('reference', $this->reference, true);
        $criteria->compare('number', $this->number);
        $criteria->compare('titre', $this->titre, true);
        $criteria->compare('dateDebut', $this->dateDebut, true);
        $criteria->compare('dateFin', $this->dateFin, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('condition', $this->condition, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('finance_rate', $this->finance_rate, TRUE);
        $criteria->compare('technique_rate', $this->technique_rate, TRUE);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AppelOffre the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getAppelOffreOptions()
    {
        if (Yii::app()->user->name === 'root')
            return CHtml::listData(AppelOffre::model()->findAll(), 'id', 'titre');

        else {
            return CHtml::listData(AppelOffre::model()->with('psConvoquer')->findAll(
                'evaluator_id=:eva', array(':eva' => Evaluator::model()->getIDByUsername(Yii::app()->user->name))),
                'id', 'titre');
        }
    }

    public function getAllReadyAppelOffre()
    {
        $appel = $this->findAll();
        $result = [];
        foreach ($appel as $value) {
            $result[$value['id']] = $value['titre'];
        }
        return $result;
    }

    public function getCurrentAppelOffre()
    {
        $lang = Yii::app()->user->getState('appelOffre', 'default');
        if ($lang === 'default') {
            return 'there is no activated appel offre';
        } else {
            return (int)$lang;
        }
    }

    public function getCurrentAppelOffreName()
    {
        $lang = Yii::app()->user->getState('appelOffre', 'default');
        if ($lang === 'default' || $lang == 0) {
            return Yii::t('app2', 'None');
        } else {
            return $this->findByPk($lang)->titre;
        }
    }

    /*
     * this function return a table that representing the configuration of the current appel offre
     */
    public function getConfiguration()
    {
        $criteriaTab = Concern::model()->findAll('appel_offre_id=:offre',
            array(':offre' => Yii::app()->user->getState('appelOffre')));
        $evaluatorTab = Convoquer::model()->findAll('appel_offre_id=:offre',
            array(':offre' => Yii::app()->user->getState('appelOffre')));
        $providerTab = Participe::model()->findAll('appel_offre_id=:offre',
            array(':offre' => Yii::app()->user->getState('appelOffre')));
        $result = array();
        $loop = max(count($criteriaTab), count($evaluatorTab), count($providerTab));
        for ($index = 0; $index < $loop; $index++) {
            $result['criteria_id'][$index] = isset($criteriaTab[$index]) ? $criteriaTab[$index]['criteria_id'] : -1;
            $result['evaluator_id'][$index] = isset($evaluatorTab[$index]) ? $evaluatorTab[$index]['evaluator_id'] : -1;
            $result['provider_id'][$index] = isset($providerTab[$index]) ? $providerTab[$index]['provider_id'] : -1;

        }
        return $result;
    }
}
