<?php

/**
 * This is the model class for table "{{provider_order}}".
 *
 * The followings are the available columns in table '{{provider_order}}':
 * @property string $provider_id
 * @property string $appel_offre_id
 * @property string $criteria_id
 * @property integer $classement
 *
 * The followings are the available model relations:
 * @property Criteria $criteria
 * @property Provider $provider
 * @property AppelOffre $appelOffre
 */
class ProviderOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{provider_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider_id, appel_offre_id, criteria_id, classement', 'required'),
			array('classement', 'numerical', 'integerOnly'=>true),
			array('provider_id, appel_offre_id, criteria_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('provider_id, appel_offre_id, criteria_id, classement', 'safe', 'on'=>'search'),
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
			'criteria' => array(self::BELONGS_TO, 'Criteria', 'criteria_id'),
			'provider' => array(self::BELONGS_TO, 'Provider', 'provider_id'),
			'appelOffre' => array(self::BELONGS_TO, 'AppelOffre', 'appel_offre_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_id' => 'Provider',
			'appel_offre_id' => 'Appel Offre',
			'criteria_id' => 'Criteria',
			'classement' => 'Classement',
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

		$criteria->compare('provider_id',$this->provider_id,true);
		$criteria->compare('appel_offre_id',$this->appel_offre_id,true);
		$criteria->compare('criteria_id',$this->criteria_id,true);
		$criteria->compare('classement',$this->classement);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProviderOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
