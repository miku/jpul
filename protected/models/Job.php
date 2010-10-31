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
* @property boolean $is_telecommute
* @property boolean $is_nation_wide
* @property integer $degree_id
* @property string $study
* @property string $sector
* @property integer $date_added
* @property integer $expiration_date
* @property integer $author_id
* @property integer $reviewer_id
* @property integer $status_id
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

public function scopes()
{
	return array(
	'published'=>array(
		'condition'=>'status_id=2',
		),
	'recently'=>array(
		'order'=>'date_added DESC',
		'limit'=>20,
		),
	);
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
		array('title, description, city, company, date_added, expiration_date, author_id, status_id', 'required'),
		array('degree_id, date_added, expiration_date, author_id, reviewer_id, status_id', 'numerical', 'integerOnly'=>true),
		array('title, company_homepage, city, state, country, study, sector', 'length', 'max'=>255),
		array('company_homepage', 'url'),
		array('zipcode', 'length', 'max'=>10),
		array('how_to_apply, is_telecommute, is_nation_wide', 'safe'),
		array('attachment', 'file', 'types'=>'pdf', 'allowEmpty'=>true),
		// The following rule is used by search().
		// Please remove those attributes that should not be searched.
		array('id, title, description, how_to_apply, company, company_homepage, zipcode, city, state, country, study, sector', 'safe', 'on'=>'search'),
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
		'date_added' => 'Date Added',
		'expiration_date' => 'Expiration Date',
		'author_id' => 'Author',
		'reviewer_id' => 'Reviewer',
		'status_id' => 'Status',
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
	$criteria->compare('date_added',$this->date_added);
	$criteria->compare('expiration_date',$this->expiration_date);
	$criteria->compare('author_id',$this->author_id);
	$criteria->compare('reviewer_id',$this->reviewer_id);
	$criteria->compare('status_id',$this->status_id);

	return new CActiveDataProvider(get_class($this), array(
		'criteria'=>$criteria,
		));
}
}