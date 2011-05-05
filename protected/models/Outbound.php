<?php

/**
 * This is the model class for table "outbound".
 *
 * The followings are the available columns in table 'outbound':
 * @property integer $id
 * @property string $location
 * @property string $url
 * @property string $text
 * @property string $more_info
 * @property string $tracking_id
 * @property integer $tracking_version
 * @property string $remote_addr
 * @property string $remote_host
 * @property integer $request_time
 * @property string $http_user_agent
 * @property string $http_accept
 * @property string $http_accept_charset
 * @property string $http_accept_encoding
 * @property string $http_accept_language
 * @property string $http_connection
 * @property string $http_host
 * @property string $remote_port
 */
class Outbound extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Outbound the static model class
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
		return 'outbound';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tracking_version, request_time', 'numerical', 'integerOnly'=>true),
			array('location, url, text, tracking_id, remote_host, http_user_agent, http_accept, http_accept_charset, http_accept_encoding, http_accept_language, http_connection, http_host', 'length', 'max'=>512),
			array('more_info', 'length', 'max'=>1024),
			array('remote_addr', 'length', 'max'=>255),
			array('remote_port', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, location, url, text, more_info, tracking_id, tracking_version, remote_addr, remote_host, request_time, http_user_agent, http_accept, http_accept_charset, http_accept_encoding, http_accept_language, http_connection, http_host, remote_port', 'safe', 'on'=>'search'),
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
			'location' => 'Location',
			'url' => 'Url',
			'text' => 'Text',
			'more_info' => 'More Info',
			'tracking_id' => 'Tracking',
			'tracking_version' => 'Tracking Version',
			'remote_addr' => 'Remote Addr',
			'remote_host' => 'Remote Host',
			'request_time' => 'Request Time',
			'http_user_agent' => 'Http User Agent',
			'http_accept' => 'Http Accept',
			'http_accept_charset' => 'Http Accept Charset',
			'http_accept_encoding' => 'Http Accept Encoding',
			'http_accept_language' => 'Http Accept Language',
			'http_connection' => 'Http Connection',
			'http_host' => 'Http Host',
			'remote_port' => 'Remote Port',
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
		$criteria->compare('location',$this->location,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('more_info',$this->more_info,true);
		$criteria->compare('tracking_id',$this->tracking_id,true);
		$criteria->compare('tracking_version',$this->tracking_version);
		$criteria->compare('remote_addr',$this->remote_addr,true);
		$criteria->compare('remote_host',$this->remote_host,true);
		$criteria->compare('request_time',$this->request_time);
		$criteria->compare('http_user_agent',$this->http_user_agent,true);
		$criteria->compare('http_accept',$this->http_accept,true);
		$criteria->compare('http_accept_charset',$this->http_accept_charset,true);
		$criteria->compare('http_accept_encoding',$this->http_accept_encoding,true);
		$criteria->compare('http_accept_language',$this->http_accept_language,true);
		$criteria->compare('http_connection',$this->http_connection,true);
		$criteria->compare('http_host',$this->http_host,true);
		$criteria->compare('remote_port',$this->remote_port,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}