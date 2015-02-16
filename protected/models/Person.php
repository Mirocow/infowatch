<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $id
 * @property string $name
 * @property string $job
 * @property string $department
 * @property string $boss
 * @property string $phone
 * @property string $imsi
 * @property string $info
 * @property integer $group_id
 *
 * The followings are the available model relations:
 * @property Device[] $devices
 * @property Group $group
 */
class Person extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id', 'numerical', 'integerOnly'=>true),
			array('job, department, boss, phone, imsi', 'length', 'max'=>45),
			array('name, info', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, job, department, boss, phone, imsi, info, group_id', 'safe', 'on'=>'search'),
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
			'devices' => array(self::HAS_MANY, 'Device', 'person_id'),
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'ФИО',
			'job' => 'Должность',
			'department' => 'Отдел',
			'boss' => 'Начальник',
			'phone' => 'Телефон',
			'imsi' => 'IMSI',
			'info' => 'Информация',
			'group_id' => 'Группа',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('boss',$this->boss,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('imsi',$this->imsi,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('group_id',$this->group_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Person the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
