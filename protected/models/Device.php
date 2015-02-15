<?php

/**
 * This is the model class for table "device".
 *
 * The followings are the available columns in table 'device':
 * @property integer $id
 * @property string $imei
 * @property string $imsi
 * @property integer $created
 * @property integer $mnc_id
 * @property integer $tac_id
 * @property integer $person_id
 *
 * The followings are the available model relations:
 * @property Mnc $mnc
 * @property Tac $tac
 * @property Person $person
 */
class Device extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'device';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('imei, imsi, created', 'required'),
			array('created, mnc_id, tac_id, person_id', 'numerical', 'integerOnly'=>true),
			array('imei, imsi', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, imei, imsi, created, mnc_id, tac_id, person_id', 'safe', 'on'=>'search'),
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
			'mnc' => array(self::BELONGS_TO, 'Mnc', 'mnc_id'),
			'tac' => array(self::BELONGS_TO, 'Tac', 'tac_id'),
			'person' => array(self::BELONGS_TO, 'Person', 'person_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'imei' => 'Imei',
			'imsi' => 'Imsi',
			'created' => 'Created',
			'mnc_id' => 'Mnc',
			'tac_id' => 'Tac',
			'person_id' => 'Person',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('imei',$this->imei,true);
		$criteria->compare('imsi',$this->imsi,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('mnc_id',$this->mnc_id);
		$criteria->compare('tac_id',$this->tac_id);
		$criteria->compare('person_id',$this->person_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Device the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
