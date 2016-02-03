<?php

/**
 * This is the model class for table "{{provider_compare}}".
 * The followings are the available columns in table '{{provider_compare}}':
 * @property string $provider_a_id
 * @property string $provider_b_id
 * @property double $mark
 * @property integer $comp
 *
 * The followings are the available model relations:
 * @property Provider $providerA
 * @property Provider $providerB
 */
class ProviderCompare extends CActiveRecord {

    public $otherMark;
    public $criteria1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{provider_compare}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('provider_a_id, provider_b_id, criteria_id, appel_offre_id, mark, comp', 'required'),
            array('mark', 'numerical', 'min' => 0, 'max' => 9,
                'tooSmall' => 'the mark must not be  lesse then 0',
                'tooBig' => 'the mark must  be  lesse then 9'),
            array('provider_a_id, provider_b_id, criteria_id, appel_offre_id', 'length', 'max' => 10),
            array('provider_a_id', 'compare', 'compareAttribute' => 'provider_b_id', 'operator' => '!='),
            array('*', 'compositeUniqueKeysValidator'),
            array('provider_a_id, provider_b_id, mark, comp, otherMark, criteria_id, criteria1', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'providerA' => array(self::BELONGS_TO, 'Provider', 'provider_a_id'),
            'providerB' => array(self::BELONGS_TO, 'Provider', 'provider_b_id'),
            'criteria' => array(self::BELONGS_TO, 'Criteria', 'criteria_id'),
            'appelOffre' => array(self::BELONGS_TO, 'AppelOffre', 'appel_offre_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'provider_a_id' => Yii::t('app', 'Provider') . ' A',
            'provider_b_id' => Yii::t('app', 'Provider') . ' B',
            'mark' => Yii::t('app1', 'Mark'),
            'comp' => Yii::t('app', 'Compare'),
            'otherMark' => Yii::t('app1', 'Mark by you'),
            'criteria_id' => Yii::t('app', 'Criteria'),
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $providers = $this->implodProviders(Yii::app()->user->getState('appelOffre'));

        $criteria->condition = '`t`.`appel_offre_id`=' . Yii::app()->user->getState('appelOffre') . ' and `t`.`criteria_id` in ('
                . implode(',', Criteria::model()->getSelectedCriteriaIDTable()) . ') and provider_a_id in'
                . ' (' . $providers . ') and provider_b_id in (' . $providers . ')';

        $criteria->compare('provider_a_id', $this->provider_a_id, true);
        $criteria->compare('provider_b_id', $this->provider_b_id, true);
        $criteria->compare('criteria_id', $this->criteria_id, true);
        $criteria->compare('mark', $this->mark);
        $criteria->compare('comp', $this->comp);
        $criteria->with = array('criteria');
        $criteria->addSearchCondition('criteria.name', $this->criteria1, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'criteria1' => array(
                        'asc' => 'criteria.name',
                        'desc' => 'criteria.name DESC'
                    ), '*',
        ))));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ProviderCompare the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function primaryKey() {
        return array('provider_a_id', 'provider_b_id', 'criteria_id', 'appel_offre_id');
    }

    public function behaviors() {
        return array(
            'ActiveRecordLogableBehavior' => 'application.behaviors.ActiveRecordLogableBehavior',
            'ECompositeUniqueKeyValidatable' => array(
                'class' => 'application.behaviors.ECompositeUniqueKeyValidatable',
                'uniqueKeys' => array(
                    'attributes' => 'provider_a_id, provider_b_id, criteria_id, appel_offre_id',
                    'errorMessage' => Yii::t('app1', 'You are already compare this providers in this criteria'),
                )
            ),
        );
    }

    function getMarkOptions() {
        return $markOptions = array(
            0 => Yii::t('app2', 'Selecte one from here'),
            1 => '1 -Même performant',
            3 => '3- Un peu plus performant',
            5 => '5 -Plus performant',
            7 => '7 -Vraiement plus performant',
            9 => '9 -Incomparable');
    }

    /*
     * get the advensment state of providers comparainson
     */

    public function getComparaisonRate() {
        $co = Provider::model()->countProvidersComparaison();
        $cp = ProviderCompare::model()->comparaisonsCountSelectedCriteria();
        if ($co==0) {
            return 0;
        } else 
        return round((100 / $co) * $cp, 0);
    }

    public function compositeUniqueKeysValidator() {
        $this->validateCompositeUniqueKeys();
    }

    /*
     * this function return all comparaison that have been done
     */

    public function getComparaisons($criteriaID) {
     //   $providers = Criteria::model()->costumIpmolde(Provider::model()->getProvidersListTable());
        $providers = $this->implodProviders(Yii::app()->user->getState('appelOffre'));
        $select = implode(',', Criteria::model()->getSelectedCriteriaIDTable());
        $result = $this->findAll('criteria_id=:criteria and appel_offre_id=:offre and provider_a_id in'
                . ' (' . $providers . ') and provider_b_id in (' . $providers . ') and criteria_id in (' . $select . ')', array(':offre' => Yii::app()->user->getState('appelOffre'), 'criteria' => $criteriaID));
        return $result;
    }

    /* public function getAllComparaisonsCount() {
      $providers =  Criteria::model()->costumIpmolde(Provider::model()->getProvidersListTable());
      $result = $this->count('criteria_id=:criteria and appel_offre_id=:offre and provider_a_id in'
      . ' ('.$providers.') and provider_b_id in (' .$providers .') and criteria_id in ('.$criteria.')',
      array(':offre'=> Yii::app()->user->getState('appelOffre'), 'criteria'=>$criteriaID));
      return $result;
      } */

    public function getComparedProviderTable($criteriaID) {
        $comparedPro = array();
        $tab = $this->getComparaisons($criteriaID);
        foreach ($tab as $key => $value) {
            $comparedPro[$key] = '(' . $value['provider_a_id'] . ' & ' . $value['provider_b_id'] . ')';
        }
        return $comparedPro;
    }

    public function ProviderListTable($providersHandler = array()) {
        $i = 0;
        foreach (Provider::model()->getProvidersList() as $value) {
            $providersHandler[$i] = $value->provider_id;
            $i++;
        }
        return $providersHandler;
    }

    public function getPossibleComparaisonTable() {
        $possibleComparaison = array();
        $providersHandler = $this->ProviderListTable();
        $cpt = 0;
        for ($i = 0; $i < count($providersHandler); $i++) {
            for ($j = $i + 1; $j < count($providersHandler); $j++) {
                $possibleComparaison[$cpt] = '(' . $providersHandler[$i] . ' & ' . $providersHandler[$j] . ')';
                $possibleComparaison[$cpt + 1] = '(' . $providersHandler[$j] . ' & ' . $providersHandler[$i] . ')';
                $cpt+=2;
            }
        }
        return $possibleComparaison;
    }

    public function customizeTablesDiffrente($bigOne, $smallOne) {
        $bool = 1;
        foreach ($bigOne as $key => $value) {
            if (isset($smallOne[$value])) {
                unset($bigOne[$key]);
                if ($key % 2 === 0) {
                    unset($bigOne[$key + 1]);
                } else {
                    unset($bigOne[$key - 1]);
                }
            } else {
                if ($bool === -1) {
                    unset($bigOne[$key]);
                }
                $bool = -1 * $bool;
            }
        }
        return $bigOne;
    }

    public function getRestedComparaison($criteria) {
        $comparedPro = array_flip($this->getComparedProviderTable($criteria));
        $possibleComparaison1 = $this->getPossibleComparaisonTable();
        $possibleComparaison = $this->customizeTablesDiffrente($possibleComparaison1, $comparedPro);
        return $possibleComparaison;
    }

    public function getRestedComparaisonReport() {
        $result = '';
        $poss = Criteria::model()->getSelectedCriteria();
        foreach ($poss as $key => $value) {
            $res = $this->getRestedComparaison($key);
            if ((count($res) != 0) && (is_array($res) )) {
                $result .= Criteria::model()->findByPk($key)->name . ' => ' . implode(', ', $res) . '<br>';
            }
        }
        return $result;
    }

    public function providersMatrixCompOffre($criteriaID, $offre) {
        //$provi = Criteria::model()->costumIpmolde(Provider::model()->getProvidersListTableOffre($offre));
        $provi = $this->implodProviders($offre);
        $providers = $this->findAll('criteria_id=:criteria_id and appel_offre_id=:offre and provider_a_id in'
                . ' (' . $provi . ') and provider_b_id in (' . $provi . ')', array(':criteria_id' => $criteriaID, ':offre' => $offre));
        $matrix = array();
        foreach ($providers as $value) {
            if ($value['comp'] === '<' || $value['comp'] === '=') {
                $matrix[$value['provider_a_id']][$value['provider_b_id']] = $value['mark'];
                $matrix[$value['provider_b_id']][$value['provider_a_id']] = 1 / $value['mark'];
            } else if ($value['comp'] === '>') {
                $matrix[$value['provider_a_id']][$value['provider_b_id']] = 1 / $value['mark'];
                $matrix[$value['provider_b_id']][$value['provider_a_id']] = $value['mark'];
            }
        } return $this->addColumnsSum($this->addOneToDiagonal($matrix));
    }

    /* this function gives the Providers Comparaison Matrix */

    public function providersMatrixComp($criteriaID) {

        return $this->providersMatrixCompOffre($criteriaID, Yii::app()->user->getState('appelOffre'));
    }

    public function addOneToDiagonal($matrix) {
        foreach ($matrix as $key => $value) {
            $matrix[$key][$key] = 1;
        }
        return $matrix;
    }

    public function addColumnsSum($matrix) {
        foreach ($matrix as $key => $value) {
            $matrix[$key]['sum'] = array_sum($value);
        }
        return $matrix;
    }

    public function addRowsSum($matrix) {
        foreach ($matrix as $key => $value) {
            $matrix['sum'][$key] = 0;
            $matrix['poidRelative'][$key] = 0;
        }
        return $matrix;
    }

    public function addPoidRelativeRows($matrix) {
        foreach ($matrix as $key => $value) {
            if ($key != 'sum' && $key != 'poidRelative') {
                $matrix['poidRelative'][$key] = round($matrix['sum'][$key] / count($matrix[$key]), 3);
            }
        }
        return $matrix;
    }

    public function relativePoidMatrix($criteriaID, $offre) {
        $matrix = $this->providersMatrixCompOffre($criteriaID, $offre);
        $matrix = $this->addRowsSum($matrix);

        foreach ($matrix as $key => $value) {
            foreach ($value as $key1 => $value1) {
                if ($key1 != 'sum' && $key != 'sum' && $key != 'poidRelative') {
                    $matrix[$key][$key1] = round($value1 / $value['sum'], 3);
                    $matrix['sum'][$key1] += $matrix[$key][$key1];
                }
            }
            unset($matrix[$key]['sum']);
        }
        return $this->addPoidRelativeRows($matrix);
    }

    public function preparToDraw($matrix) {
        foreach ($matrix as $key => $value) {
            $matrix[$key]['prov'] = $key;
        }
        foreach ($matrix as $key => $value) {
            $matrix['prov'][$key] = $key;
        }
        return $matrix;
    }

    public function addRowsSum2($matrix) {
        foreach ($matrix as $key => $value) {
            $matrix['sum'][$key] = 0;
        }
        return $matrix;
    }

    public function poidRelativeSums($offre) {
        $matrix = array();
        //$result = $this->addRowsSum2($result);
        $result = array();
        $criterias = Criteria::model()->getSelectedCriteria();
        foreach ($criterias as $k => $value) {
            $sum = 0;
            $matrix = ProviderCompare::model()->relativePoidMatrix($k, $offre);
            foreach ($matrix['poidRelative'] as $key => $value1) {
                $result[Criteria::model()->findByPK($k)->name][$key] = $value1;
                $sum += $value1;
                // $result['SUM'][$key] = (isset($result['SUM'][$key])) ? $result['SUM'][$key] + $value1 : $value1;
            }
            $result[Criteria::model()->findByPK($k)->name]['sum'] = $sum;
        }

        return $result;
    }
    public function readyOffre($offre) {
        return (Provider::model()->countProvidersComparaisonOffre($offre) ==
                ProviderCompare::model()->comparaisonsCountSelectedCriteria() &&
                (Provider::model()->countProvidersComparaison() != 0)) ? TRUE : FALSE;
    }

    public function ready() {
        return $this->readyOffre(Yii::app()->user->getState('appelOffre'));
    }

    public function configureFinance() {
        $provider = Participe::model()->findAll('appel_offre_id=' . Yii::app()->user->getState('appelOffre'));
        $bool = 0;
        $rest = array();
        $i = 0;
        foreach ($provider as $value) {
            if ($value->finance == 0) {
                $bool = 1;
                $rest[$i] = $value->provider_id;
                $i++;
            }
        }
        if ($bool == 0) {
            return $bool;
        } else {
            return $rest;
        }
    }

    public function financialOffreConfiguration($var) {
        $result = '';
        foreach ($var as $key => $value) {
            $result .= $value . '<br/>';
        }
        return $result;
    }

    /*
     * this function return the number of comparaison in this appel offre
     */
    public function implodProviders($offre){
        $providers =array();
        $i =0 ;
        foreach (Provider::model()->getProvidersListTableOffre($offre) as  $value) {
            $providers[$i] = '"'.$value.'"';
            $i++;
        }
        return implode(',', $providers);
    }

    public function comparaisonsCountSelectedCriteria() {
        
        return $this->comparaisonsCountSelectedCriteriaOffre($this->implodProviders(Yii::app()->user->getState('appelOffre')));
    }

    public function comparaisonsCountSelectedCriteriaOffre($providers) {
        $select = implode(',', Criteria::model()->getSelectedCriteriaIDTable());
        if ($select == '' || $providers == '') {
            return 0;
        } else {
            $result = $this->count('appel_offre_id=:offre and provider_a_id in'
                    . ' (' . $providers . ') and provider_b_id in (' . $providers . ') and criteria_id in (' . $select . ')', array(':offre' => Yii::app()->user->getState('appelOffre'),));
            return $result;
        }
    }

    public function finalM($offre) {
        $matrix = array();
        $result = array();
        $_technique = AppelOffre::model()->findByPk($offre)->technique_rate;
        $criterias = Criteria::model()->getSelectedCriteriaOffre($offre);
        foreach ($criterias as $k => $value) {
            $sum = 0;
            $matrix = ProviderCompare::model()->relativePoidMatrix($k, $offre);
            foreach ($matrix['poidRelative'] as $key => $value1) {
                $val = ($value1 * $value);
                $result[Criteria::model()->findByPK($k)->name][$key] = $val;
                $sum += $val;
                $result['SUM'][$key] = (isset($result['SUM'][$key])) ? $result['SUM'][$key] + $val : $val;
            }
            $result[Criteria::model()->findByPK($k)->name]['sum'] = $sum;
        }
        $max = max($result['SUM']);
        $finance = $this->financeMarkOffre($offre);
        $finalePoint = 0;
        $pointFinancier = 0;
        $pointTechnique = 0;
        foreach ($result['SUM'] as $key1 => $val) {
            if ($key1 != 'sum') {
                $result['point technique'][$key1] = ($val * $_technique) / $max;
                $result['point financière'][$key1] = $finance[$key1];
                $result['Finale Point'][$key1] = $result['point technique'][$key1] + $result['point financière'][$key1];
                $finalePoint += $result['Finale Point'][$key1];
                $pointFinancier += $result['point financière'][$key1];
                $pointTechnique += $result['point technique'][$key1];
            }
        }
        $result['Finale Point']['sum'] = $finalePoint;
        $result['point financière']['sum'] = $pointFinancier;
        $result['point technique']['sum'] = $pointTechnique;
        return $result;
    }

    public function finaleMatrix() {
        return $this->finalM(Yii::app()->user->getState('appelOffre'));
    }

    public function getWinner($appel) {
        $tab = $this->finalM($appel)['Finale Point'];
        unset($tab['sum']);
        $max = max($tab);
        $select = '';

        foreach ($tab as $key => $value) {
            if ($value == $max) {
                $select = $key;
                break;
            }
        }
        return Provider::model()->findByPk($select);
    }

    public function financeMarkOffre($offre) {
        $prov = Participe::model()->findAll('appel_offre_id=' . $offre);
        $array = array();
        $_finance = AppelOffre::model()->findByPk($offre)->finance_rate;
        foreach ($prov as $value) {
            $array[$value['provider_id']] = $value['finance'];
        }
        $min = min($array);
        foreach ($array as $key => $value) {
            $array[$key] = ($min * $_finance) / $value;
        }
        return $array;
    }

    public function financeMark() {
        return $this->financeMarkOffre(Yii::app()->user->getState('appelOffre'));
    }

}