<?php

/**
 * This is the model class for table "job".
 *
 * The followings are the available columns in table 'job':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $how_to_apply
 * @property string $attachment
 * @property string $company
 * @property string $company_homepage
 * @property string $zipcode
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $is_telecommute
 * @property integer $is_nation_wide
 * @property integer $degree_id
 * @property string $study
 * @property string $sector
 * @property integer $author_id
 * @property integer $date_added
 * @property integer $expiration_date
 * @property integer $reviewer_id
 * @property string $source
 * @property integer $status_id
 * @property integer $is_fulltime
 * @property integer $is_parttime
 * @property integer $is_internship
 * @property integer $is_voluntary_service
 * @property integer $is_regular_job
 * @property integer $is_scientific_position
 * @property integer $is_working_student_position
 *
 * The followings are the available model relations:
 */
class Job extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Job the static model class
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
		return 'job';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, company, city, author_id, date_added, expiration_date, status_id', 'required'),
			array('is_telecommute, is_nation_wide, degree_id, author_id, date_added, expiration_date, reviewer_id, status_id, is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position, is_working_student_position', 'numerical', 'integerOnly'=>true),
			array('title, attachment, company_homepage, city, state, country, study, sector, source', 'length', 'max'=>255),
			array('company', 'length', 'max'=>1000),
			array('zipcode', 'length', 'max'=>10),
			array('how_to_apply', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, how_to_apply, attachment, company, company_homepage, zipcode, city, state, country, is_telecommute, is_nation_wide, degree_id, study, sector, author_id, date_added, expiration_date, reviewer_id, source, status_id, is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position, is_working_student_position', 'safe', 'on'=>'search'),
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
			'degree' => array(self::BELONGS_TO, 'Degree', 'degree_id'),
			'status' => array(self::BELONGS_TO, 'JobStatus', 'status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'description' => Yii::t('app', 'Description'),
			'how_to_apply' => Yii::t('app', 'How To Apply'),
			'attachment' => Yii::t('app', 'Attachment'),
			'company' => Yii::t('app', 'Company'),
			'company_homepage' => Yii::t('app', 'Company Homepage'),
			'zipcode' => Yii::t('app', 'Zipcode'),
			'city' => Yii::t('app', 'City'),
			'state' => Yii::t('app', 'State'),
			'country' => Yii::t('app', 'Country'),
			'is_telecommute' => Yii::t('app', 'Is Telecommute'),
			'is_nation_wide' => Yii::t('app', 'Is Nation Wide'),
			'degree_id' => Yii::t('app', 'Degree'),
			'study' => Yii::t('app', 'Study'),
			'sector' => Yii::t('app', 'Sector'),
			'author_id' => Yii::t('app', 'Author'),
			'date_added' => Yii::t('app', 'Date Added'),
			'expiration_date' => Yii::t('app', 'Expiration Date'),
			'reviewer_id' => Yii::t('app', 'Reviewer'),
			'source' => Yii::t('app', 'Source'),
			'status_id' => Yii::t('app', 'Status'),
			'is_fulltime' => Yii::t('app', 'Is Fulltime'),
			'is_parttime' => Yii::t('app', 'Is Parttime'),
			'is_internship' => Yii::t('app', 'Is Internship'),
			'is_voluntary_service' => Yii::t('app', 'Is Voluntary Service'),
			'is_regular_job' => Yii::t('app', 'Is Regular Job'),
			'is_scientific_position' => Yii::t('app', 'Is Scientific Position'),
			'is_working_student_position' => Yii::t('app', 'Is Working Student Position'),
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('how_to_apply',$this->how_to_apply,true);
		$criteria->compare('attachment',$this->attachment,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('company_homepage',$this->company_homepage,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('is_telecommute',$this->is_telecommute);
		$criteria->compare('is_nation_wide',$this->is_nation_wide);
		$criteria->compare('degree_id',$this->degree_id);
		$criteria->compare('study',$this->study,true);
		$criteria->compare('sector',$this->sector,true);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('date_added',$this->date_added);
		$criteria->compare('expiration_date',$this->expiration_date);
		$criteria->compare('reviewer_id',$this->reviewer_id);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('is_fulltime',$this->is_fulltime);
		$criteria->compare('is_parttime',$this->is_parttime);
		$criteria->compare('is_internship',$this->is_internship);
		$criteria->compare('is_voluntary_service',$this->is_voluntary_service);
		$criteria->compare('is_regular_job',$this->is_regular_job);
		$criteria->compare('is_scientific_position',$this->is_scientific_position);
		$criteria->compare('is_working_student_position',$this->is_working_student_position);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}