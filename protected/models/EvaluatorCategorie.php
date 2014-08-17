<?php

/**
 * This is the model class for table "{{evaluator_categorie}}".
 *
 * The followings are the available columns in table '{{evaluator_categorie}}':
 * @property string $categorie_id
 * @property string $evaluator_id
 */
class EvaluatorCategorie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{evaluator_categorie}}';
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
			array('categorie_id, evaluator_id', 'required'),
			array('categorie_id, evaluator_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('categorie_id, evaluator_id', 'safe', 'on'=>'search'),
		);
	}
        
        public function behaviors() {
        return array(
            'ActiveRecordLogableBehavior' => 'application.behaviors.ActiveRecordLogableBehavior',
            'ECompositeUniqueKeyValidatable' => array(
                'class' => 'application.behaviors.ECompositeUniqueKeyValidatable',
                'uniqueKeys' => array(
                    'attributes' => 'categorie_id, evaluator_id',
                    'errorMessage' => 'Vous avez déja efféctuer cet evaluateur a cette categorie'
                )
            ),
        );
    }

    public function primaryKey() {
        return array('evaluator_id', 'categorie_id');
    }
    public function compositeUniqueKeysValidator() {
        $this->validateCompositeUniqueKeys();
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
			'categorie_id' =>Yii::t('app', 'Categorie') ,
			'evaluator_id' =>Yii::t('app', 'Evaluator') ,
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

		$criteria->compare('categorie_id',$this->categorie_id,true);
		$criteria->compare('evaluator_id',$this->evaluator_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EvaluatorCategorie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
