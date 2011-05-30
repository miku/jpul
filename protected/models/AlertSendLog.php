<?php

/**
 * This is the model class for table "alert_send_log".
 *
 * The followings are the available columns in table 'alert_send_log':
 * @property integer $id
 * @property integer $alert_id
 * @property integer $job_id
 * @property integer $date_sent
 */
class AlertSendLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AlertSendLog the static model class
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
		return 'alert_send_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alert_id, job_id, date_sent', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, alert_id, job_id, date_sent', 'safe', 'on'=>'search'),
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
			'alert_id' => 'Alert',
			'job_id' => 'Job',
			'date_sent' => 'Date Sent',
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
		$criteria->compare('alert_id',$this->alert_id);
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('date_sent',$this->date_sent);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}