<?php

/**
 * This is the model class for table "{{provider}}".
 *
 * The followings are the available columns in table '{{provider}}':
 * @property string $id
 * @property string $name
 * @property string $pastal_address
 * @property string $email
 *
 * The followings are the available model relations:
 * @property ProviderCompare[] $providerCompares
 * @property ProviderCompare[] $providerCompares1
 */
class Provider extends CActiveRecord {

    public function tableName() {
        return '{{provider}}';
    }

    public $finance = 15;
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('id', 'required'),
            array('id, name', 'unique'),
            array('id, post_code', 'length', 'max' => 10),
	    array('phone', 'length', 'max' => 30),
            array('id', 'match', 'pattern' => '/^([F]?[0-9]+)$/', 'message' => 'the ID must begin with a big "F" then an integer'),
            array('name', 'length', 'max' => 512),
            array('postal_address', 'length', 'max' => 512),
            array('email', 'length', 'max' => 255),
            array('email', 'email'),
            array('id, name, postal_address, email, phone, post_code', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'providerCompares' => array(self::HAS_MANY, 'ProviderCompare', 'provider_a_id'),
            'providerCompares1' => array(self::HAS_MANY, 'ProviderCompare', 'provider_b_id'),
            'psParticipe' => array(self::MANY_MANY, 'AppelOffre', '{{participe}}(provider_id, appel_offre_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
   
    public function attributeLabels() {
        return array(
            'id' =>Yii::t('app', 'ID'),
            'name' =>Yii::t('app1', 'Name') ,
            'email' =>Yii::t('app1', 'Email') ,
            'postal_Address' =>Yii::t('app1', 'Address') ,
            'phone'=>Yii::t('app1', 'Phone') ,
            'post_code'=>Yii::t('app1', 'Post code') ,
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('postal_address', $this->postal_address, true);
        $criteria->compare('email', $this->email, true);
		$criteria->compare('post_code', $this->post_code, true);
		$criteria->compare('phone', $this->phone, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function behaviors() {
        return array(
            // Classname => path to Class
            'ActiveRecordLogableBehavior' =>
            'application.behaviors.ActiveRecordLogableBehavior',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Provider the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function getProvidersListOffre($offre){
        return Participe::model()->findall('appel_offre_id=:offre', array(
            ':offre'=> $offre,
                ));
    }
    /*
     * get providers list for this project
     */
    public function getProvidersList() {
        return $this->getProvidersListOffre(Yii::app()->user->getState('appelOffre'));
    }

    public function getProviders() {
        return CHtml::listData(provider::model()->getProvidersList(), 'provider_id', 'provider_id');
    }
    
    /*
     * this function return provider ID list table that participated to this project 
     */
    public function getProvidersListTableOffre($offre){
        $result = array(); // table that will handel providers id (the result)
        foreach ($this->getProvidersListOffre($offre) as $key => $value) {
            $result[$key] = $value->provider_id;
        }
        return $result;
    }
    public function getProvidersListTable(){
        return $this->getProvidersListOffre(Yii::app()->user->getState('appelOffre'));
    }
   
    /*
     * retun the number of all possible comparaison
     */
    public function countProvidersComparaisonOffre($offre){
        $cin =count(Provider::model()->getProvidersListOffre($offre));
        $count = $cin - 1;
        for ($i = 1; $i < $cin; $i++) {
            $count+=($cin - $i - 1);
        }
        return $count * count(Criteria::model()->getSelectedCriteria());
    }
    public function countProvidersComparaison() {
        return $this->countProvidersComparaisonOffre(Yii::app()->user->getState('appelOffre'));
    }

    public function getProvidersInOrder() {
        
        return Yii::app()->db->createCommand('select `provider_id` from `ps_participe` where(`appel_offre_id`=:offre) ORDER BY  `provider_id` ASC ')
                ->queryAll(true,array(':offre'=> Yii::app()->user->getState('appelOffre')) );
    }

    public function getProvidersTable() {
        $ech = $this->getProvidersInOrder();
        $tab = array();
        foreach ($ech as $key => $value) {
            foreach ($value as  $value1) {
                $tab[$key] = $value1;
            }
           
        }
        return $tab;
    }
    public function getTableForDraw($criteria){
        $matrix = ProviderCompare::model()->providersMatrixComp($criteriaID);
        $draw = $this->getProvidersTable();
    }
    public function getFinaleMark($providerID){
        return round(ProviderCompare::model()->poidRelativeSums()['point'][$providerID]);
    }
    
    
    public function getRestedProvider(){
        $result = array();
        $sql = 'select `name` from `ps_provider` ev 
        where (ev.id not in (select `provider_id` from `ps_participe` where `appel_offre_id`=:app_id) )';
        $cmd = Yii::app()->db->createCommand($sql);
        $cmdRe = $cmd->queryAll(TRUE, array(':app_id'=>  Yii::app()->user->getState('appelOffre')));
        foreach ($cmdRe as $key=>$value){
            $result[$key] = $value['name'];
        }
        return $result;
    }
    public function getProviderUpdateOption(){
        $tab = Participe::model()->findAll('appel_offre_id=:offre', array(':offre'=>  Yii::app()->user->getState('appelOffre')));
        $result = array();$i =0 ;
        foreach ($tab as $value) {
            $result[$i] = Provider::model()->findByPk($value['provider_id']);
            $i++;
        }
        
        return $result;
    }
    public function getProviderUpdateOptions(){
        $tab = Participe::model()->findAll('appel_offre_id=:offre', array(':offre'=>  Yii::app()->user->getState('appelOffre')));
        $result = array();$i =0 ;
        foreach ($tab as $value) {
            $result[$i] = Provider::model()->findByPk($value['provider_id'])->id;
            $i++;
        }
        return $result;
    }
    public function getIDByName($name){
        return $this->find('name=:name', array(':name'=>$name))->id;
    }

}