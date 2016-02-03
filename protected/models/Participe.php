<?php

/**
 * This is the model class for table "{{participe}}".
 *
 * The followings are the available columns in table '{{participe}}':
 * @property string $appel_offre_id
 * @property string $provider_id
 * @property string $finance
 */
class Participe extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{participe}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('*', 'compositeUniqueKeysValidator'), 
			array('appel_offre_id, provider_id, finance', 'required'),
			array('appel_offre_id, provider_id', 'length', 'max'=>10),
                    array('finance', 'length', 'max'=>32),
                    array('finance', 'numerical', 'integerOnly'=>TRUE),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('appel_offre_id, provider_id, finance', 'safe', 'on'=>'search'),
		);
	}
        
        public function compositeUniqueKeysValidator() {
        $this->validateCompositeUniqueKeys();
    }
    
        public function behaviors() {
        return array(
            'ActiveRecordLogableBehavior' => 'application.behaviors.ActiveRecordLogableBehavior',
            'ECompositeUniqueKeyValidatable' => array(
                'class' => 'application.behaviors.ECompositeUniqueKeyValidatable',
                'uniqueKeys' => array(
                    'attributes' => 'appel_offre_id, provider_id',
                    'errorMessage' => 'Ce fournisseur déjà participer dans cette appel d\'offre'
                )
            ),
        );
    }
    
    public function primaryKey() {
        return array('appel_offre_id', 'provider_id');
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'appel_offre_id' =>Yii::t('app', 'call for tenders') ,
			'provider_id' =>Yii::t('app', 'Provider'),
                             'finance' =>Yii::t('app', 'finance'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('appel_offre_id',$this->appel_offre_id,true);
		$criteria->compare('provider_id',$this->provider_id,true);
                $criteria->compare('finance',$this->finance,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Participe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
