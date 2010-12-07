<?php

/**
 * This is the model class for table "request".
 *
 * The followings are the available columns in table 'request':
 * @property integer $id
 * @property string $addr
 * @property integer $request_time
 * @property string $request_path
 * @property string $user_agent
 * @property string $more_info
 *
 * The followings are the available model relations:
 */
class Request extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Request the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('request_time', 'numerical', 'integerOnly'=>true),
			array('addr', 'length', 'max'=>255),
			array('request_path, user_agent', 'length', 'max'=>512),
			array('more_info', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, addr, request_time, request_path, user_agent, more_info', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'addr' => 'Addr',
			'request_time' => 'Request Time',
			'request_path' => 'Request Path',
			'user_agent' => 'User Agent',
			'more_info' => 'More Info',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('addr',$this->addr,true);
		$criteria->compare('request_time',$this->request_time);
		$criteria->compare('request_path',$this->request_path,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('more_info',$this->more_info,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}