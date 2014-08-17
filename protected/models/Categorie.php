<?php

/**
 * This is the model class for table "{{categorie}}".
 *
 * The followings are the available columns in table '{{categorie}}':
 * @property string $id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Criteria[] $psCriterias
 * @property Evaluator[] $psEvaluators
 */
class Categorie extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{categorie}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>256),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description', 'safe', 'on'=>'search'),
		);
	}
        public function behaviors() {
        return array(
            // Classname => path to Class
            'ActiveRecordLogableBehavior' =>
            'application.behaviors.ActiveRecordLogableBehavior',
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'psCriterias' => array(self::MANY_MANY, 'Criteria', '{{criteria_categorie}}(categorie_id, criteria_id)'),
			'psEvaluators' => array(self::MANY_MANY, 'Evaluator', '{{evaluator_categorie}}(categorie_id, evaluator_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' =>Yii::t('app', 'ID') ,
			'name' =>Yii::t('app1', 'Name'),
			'description' =>Yii::t('app', 'Description') ,
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categorie the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        public function getCategorieOptions(){
            return CHtml::listData(Categorie::model()->findAll(), 'id', 'name');
        }
}
