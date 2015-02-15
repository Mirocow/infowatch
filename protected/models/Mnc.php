<?php

/**
 * This is the model class for table "mnc".
 *
 * The followings are the available columns in table 'mnc':
 * @property integer $id
 * @property integer $mcc
 * @property string $mnc
 * @property string $brand
 * @property string $operator
 * @property string $status
 * @property string $bands
 * @property string $comments
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Device[] $devices
 */
class Mnc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mnc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('updated', 'required'),
			array('mcc', 'numerical', 'integerOnly'=>true),
			array('mnc', 'length', 'max'=>5),
			array('brand, status', 'length', 'max'=>45),
			array('operator', 'length', 'max'=>200),
			array('bands, comments', 'length', 'max'=>445),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mcc, mnc, brand, operator, status, bands, comments, updated', 'safe', 'on'=>'search'),
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
			'devices' => array(self::HAS_MANY, 'Device', 'mnc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mcc' => 'Mcc',
			'mnc' => 'Mnc',
			'brand' => 'Brand',
			'operator' => 'Operator',
			'status' => 'Status',
			'bands' => 'Bands',
			'comments' => 'Comments',
			'updated' => 'Updated',
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
		$criteria->compare('mcc',$this->mcc);
		$criteria->compare('mnc',$this->mnc,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('operator',$this->operator,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('bands',$this->bands,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mnc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
