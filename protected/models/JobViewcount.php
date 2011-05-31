<?php

/**
 * This is the model class for table "job_viewcount".
 *
 * The followings are the available columns in table 'job_viewcount':
 * @property integer $id
 * @property integer $job_id
 * @property string $job_title
 * @property integer $view_count
 * @property integer $date_updated
 */
class JobViewcount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobViewcount the static model class
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
		return 'job_viewcount';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('job_id, view_count, date_updated', 'numerical', 'integerOnly'=>true),
			array('job_title', 'length', 'max'=>512),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_id, job_title, view_count, date_updated', 'safe', 'on'=>'search'),
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
			'job_id' => 'Job',
			'job_title' => 'Job Title',
			'view_count' => 'View Count',
			'date_updated' => 'Date Updated',
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
		$criteria->compare('job_id',$this->job_id);
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('date_updated',$this->date_updated);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}