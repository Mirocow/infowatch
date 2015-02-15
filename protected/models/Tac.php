<?php

/**
 * This is the model class for table "tac".
 *
 * The followings are the available columns in table 'tac':
 * @property integer $id
 * @property string $tac
 * @property string $manufacter
 * @property string $model
 * @property string $version
 * @property string $os_type
 * @property string $created
 * @property string $lte
 * @property integer $os
 *
 * The followings are the available model relations:
 * @property Device[] $devices
 */
class Tac extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tac';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tac, manufacter', 'required'),
			array('os', 'numerical', 'integerOnly'=>true),
			array('tac', 'length', 'max'=>8),
			array('manufacter, os_type, created', 'length', 'max'=>45),
			array('model', 'length', 'max'=>500),
			array('version', 'length', 'max'=>2000),
			array('lte', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, tac, manufacter, model, version, os_type, created, lte, os', 'safe', 'on'=>'search'),
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
			'devices' => array(self::HAS_MANY, 'Device', 'tac_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tac' => 'Tac',
			'manufacter' => 'Manufacter',
			'model' => 'Model',
			'version' => 'Version',
			'os_type' => 'Os Type',
			'created' => 'Created',
			'lte' => 'Lte',
			'os' => 'Os',
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
		$criteria->compare('tac',$this->tac,true);
		$criteria->compare('manufacter',$this->manufacter,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('version',$this->version,true);
		$criteria->compare('os_type',$this->os_type,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('lte',$this->lte,true);
		$criteria->compare('os',$this->os);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tac the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
