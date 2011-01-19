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
			array('title, description, company, author_id, date_added, expiration_date, status_id', 'required'),
			array('is_telecommute, is_nation_wide, degree_id, author_id, date_added, expiration_date, reviewer_id, status_id, is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position', 'numerical', 'integerOnly'=>true),
			array('title, attachment, company_homepage, city, state, country, study, sector, source', 'length', 'max'=>255),
			array('company', 'length', 'max'=>1000),
			array('zipcode', 'length', 'max'=>10),
			array('how_to_apply', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, how_to_apply, attachment, company, company_homepage, zipcode, city, state, country, is_telecommute, is_nation_wide, degree_id, study, sector, author_id, date_added, expiration_date, reviewer_id, source, status_id, is_fulltime, is_parttime, is_internship, is_voluntary_service, is_regular_job, is_scientific_position', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'description' => 'Description',
			'how_to_apply' => 'How To Apply',
			'attachment' => 'Attachment',
			'company' => 'Company',
			'company_homepage' => 'Company Homepage',
			'zipcode' => 'Zipcode',
			'city' => 'City',
			'state' => 'State',
			'country' => 'Country',
			'is_telecommute' => 'Is Telecommute',
			'is_nation_wide' => 'Is Nation Wide',
			'degree_id' => 'Degree',
			'study' => 'Study',
			'sector' => 'Sector',
			'author_id' => 'Author',
			'date_added' => 'Date Added',
			'expiration_date' => 'Expiration Date',
			'reviewer_id' => 'Reviewer',
			'source' => 'Source',
			'status_id' => 'Status',
			'is_fulltime' => 'Is Fulltime',
			'is_parttime' => 'Is Parttime',
			'is_internship' => 'Is Internship',
			'is_voluntary_service' => 'Is Voluntary Service',
			'is_regular_job' => 'Is Regular Job',
			'is_scientific_position' => 'Is Scientific Position',
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

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}