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
 * @property integer $degree_student
 * @property integer $degree_bachelor
 * @property integer $degree_master
 * @property integer $degree_ma
 * @property integer $degree_diploma
 * @property integer $degree_phd
 * @property integer $degree_postdoc
 * @property integer $degree_encoded
 * @property integer $is_fulltime
 * @property integer $is_parttime
 * @property integer $is_internship
 * @property integer $is_working_student
 * @property integer $is_thesis
 * @property integer $is_scholarship
 * @property integer $is_regular_job
 * @property integer $is_scientific_position
 * @property string $publisher_name
 * @property string $publisher_phone
 * @property string $publisher_email
 * @property string $job_version
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
	
	public function isExpired() {
		$current_time = time();
		return $current_time > $this->expiration_date;
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, company, author_id, city, date_added, expiration_date, status_id', 'required'),
			array('is_telecommute, is_nation_wide, degree_id, author_id, date_added, expiration_date, reviewer_id, status_id, degree_student, degree_bachelor, degree_master, degree_ma, degree_diploma, degree_phd, degree_postdoc, degree_encoded, is_fulltime, is_parttime, is_internship, is_working_student, is_thesis, is_scholarship, is_regular_job, is_scientific_position', 'numerical', 'integerOnly'=>true),
			array('title, attachment, company_homepage, city, state, country, study, sector, source', 'length', 'max'=>255),
			array('company', 'length', 'max'=>1000),
			array('zipcode', 'length', 'max'=>10),
			array('publisher_name, publisher_phone, publisher_email', 'length', 'max'=>128),
			array('job_version', 'length', 'max'=>16),
			array('how_to_apply', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, how_to_apply, attachment, company, company_homepage, zipcode, city, state, country, is_telecommute, is_nation_wide, degree_id, study, sector, author_id, date_added, expiration_date, reviewer_id, source, status_id, degree_student, degree_bachelor, degree_master, degree_ma, degree_diploma, degree_phd, degree_postdoc, degree_encoded, is_fulltime, is_parttime, is_internship, is_working_student, is_thesis, is_scholarship, is_regular_job, is_scientific_position, publisher_name, publisher_phone, publisher_email, job_version', 'safe', 'on'=>'search'),
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
			'degree_student' => Yii::t('app', 'Degree Student'),
			'degree_bachelor' => Yii::t('app', 'Degree Bachelor'),
			'degree_master' => Yii::t('app', 'Degree Master'),
			'degree_ma' => Yii::t('app', 'Degree Ma'),
			'degree_diploma' => Yii::t('app', 'Degree Diploma'),
			'degree_phd' => Yii::t('app', 'Degree Phd'),
			'degree_postdoc' => Yii::t('app', 'Degree Postdoc'),
			'degree_encoded' => Yii::t('app', 'Degree Encoded'),
			'is_fulltime' => Yii::t('app', 'Is Fulltime'),
			'is_parttime' => Yii::t('app', 'Is Parttime'),
			'is_internship' => Yii::t('app', 'Is Internship'),
			'is_working_student' => Yii::t('app', 'Is Working Student'),
			'is_thesis' => Yii::t('app', 'Is Thesis'),
			'is_scholarship' => Yii::t('app', 'Is Scholarship'),
			'is_regular_job' => Yii::t('app', 'Is Regular Job'),
			'is_scientific_position' => Yii::t('app', 'Is Scientific Position'),
			'publisher_name' => Yii::t('app', 'Publisher Name'),
			'publisher_phone' => Yii::t('app', 'Publisher Phone'),
			'publisher_email' => Yii::t('app', 'Publisher Email'),
			'job_version' => Yii::t('app', 'Job Version'),
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
		$criteria->compare('degree_student',$this->degree_student);
		$criteria->compare('degree_bachelor',$this->degree_bachelor);
		$criteria->compare('degree_master',$this->degree_master);
		$criteria->compare('degree_ma',$this->degree_ma);
		$criteria->compare('degree_diploma',$this->degree_diploma);
		$criteria->compare('degree_phd',$this->degree_phd);
		$criteria->compare('degree_postdoc',$this->degree_postdoc);
		$criteria->compare('degree_encoded',$this->degree_encoded);
		$criteria->compare('is_fulltime',$this->is_fulltime);
		$criteria->compare('is_parttime',$this->is_parttime);
		$criteria->compare('is_internship',$this->is_internship);
		$criteria->compare('is_working_student',$this->is_working_student);
		$criteria->compare('is_thesis',$this->is_thesis);
		$criteria->compare('is_scholarship',$this->is_scholarship);
		$criteria->compare('is_regular_job',$this->is_regular_job);
		$criteria->compare('is_scientific_position',$this->is_scientific_position);
		$criteria->compare('publisher_name',$this->publisher_name,true);
		$criteria->compare('publisher_phone',$this->publisher_phone,true);
		$criteria->compare('publisher_email',$this->publisher_email,true);
		$criteria->compare('job_version',$this->job_version,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}