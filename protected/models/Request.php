<?php

/**
 * This is the model class for table "request".
 *
 * The followings are the available columns in table 'request':
 * @property integer $id
 * @property string $remote_addr
 * @property integer $request_time
 * @property string $request_uri
 * @property string $http_user_agent
 * @property string $more_info
 * @property string $tracking_id
 * @property string $request_method
 * @property string $http_referer
 * @property string $http_accept
 * @property string $http_accept_charset
 * @property string $http_accept_encoding
 * @property string $http_accept_language
 * @property string $http_connection
 * @property string $http_host
 * @property string $remote_port
 * @property string $window_height
 * @property string $window_width
 * @property string $screen_height
 * @property string $screen_width
 * @property string $screen_colordepth
 * @property string $navigator_appversion
 * @property string $bt_browser
 * @property string $bt_version
 * @property string $bt_os
 * @property string $request_uri_wo_qs
 * @property string $request_uri_wo_qs_and_hostname
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
			array('remote_addr', 'length', 'max'=>255),
			array('request_uri, http_user_agent, tracking_id, request_method, http_referer, http_accept, http_accept_charset, http_accept_encoding, http_accept_language, http_connection, http_host, request_uri_wo_qs, request_uri_wo_qs_and_hostname', 'length', 'max'=>512),
			array('more_info, navigator_appversion, bt_browser, bt_version', 'length', 'max'=>1024),
			array('remote_port', 'length', 'max'=>32),
			array('window_height, window_width, screen_height, screen_width, screen_colordepth', 'length', 'max'=>64),
			array('bt_os', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, remote_addr, request_time, request_uri, http_user_agent, more_info, tracking_id, request_method, http_referer, http_accept, http_accept_charset, http_accept_encoding, http_accept_language, http_connection, http_host, remote_port, window_height, window_width, screen_height, screen_width, screen_colordepth, navigator_appversion, bt_browser, bt_version, bt_os, request_uri_wo_qs, request_uri_wo_qs_and_hostname', 'safe', 'on'=>'search'),
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
			'remote_addr' => 'Remote Addr',
			'request_time' => 'Request Time',
			'request_uri' => 'Request Uri',
			'http_user_agent' => 'Http User Agent',
			'more_info' => 'More Info',
			'tracking_id' => 'Tracking',
			'request_method' => 'Request Method',
			'http_referer' => 'Http Referer',
			'http_accept' => 'Http Accept',
			'http_accept_charset' => 'Http Accept Charset',
			'http_accept_encoding' => 'Http Accept Encoding',
			'http_accept_language' => 'Http Accept Language',
			'http_connection' => 'Http Connection',
			'http_host' => 'Http Host',
			'remote_port' => 'Remote Port',
			'window_height' => 'Window Height',
			'window_width' => 'Window Width',
			'screen_height' => 'Screen Height',
			'screen_width' => 'Screen Width',
			'screen_colordepth' => 'Screen Colordepth',
			'navigator_appversion' => 'Navigator Appversion',
			'bt_browser' => 'Bt Browser',
			'bt_version' => 'Bt Version',
			'bt_os' => 'Bt Os',
			'request_uri_wo_qs' => 'Request Uri Wo Qs',
			'request_uri_wo_qs_and_hostname' => 'Request Uri Wo Qs And Hostname',
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
		$criteria->compare('remote_addr',$this->remote_addr,true);
		$criteria->compare('request_time',$this->request_time);
		$criteria->compare('request_uri',$this->request_uri,true);
		$criteria->compare('http_user_agent',$this->http_user_agent,true);
		$criteria->compare('more_info',$this->more_info,true);
		$criteria->compare('tracking_id',$this->tracking_id,true);
		$criteria->compare('request_method',$this->request_method,true);
		$criteria->compare('http_referer',$this->http_referer,true);
		$criteria->compare('http_accept',$this->http_accept,true);
		$criteria->compare('http_accept_charset',$this->http_accept_charset,true);
		$criteria->compare('http_accept_encoding',$this->http_accept_encoding,true);
		$criteria->compare('http_accept_language',$this->http_accept_language,true);
		$criteria->compare('http_connection',$this->http_connection,true);
		$criteria->compare('http_host',$this->http_host,true);
		$criteria->compare('remote_port',$this->remote_port,true);
		$criteria->compare('window_height',$this->window_height,true);
		$criteria->compare('window_width',$this->window_width,true);
		$criteria->compare('screen_height',$this->screen_height,true);
		$criteria->compare('screen_width',$this->screen_width,true);
		$criteria->compare('screen_colordepth',$this->screen_colordepth,true);
		$criteria->compare('navigator_appversion',$this->navigator_appversion,true);
		$criteria->compare('bt_browser',$this->bt_browser,true);
		$criteria->compare('bt_version',$this->bt_version,true);
		$criteria->compare('bt_os',$this->bt_os,true);
		$criteria->compare('request_uri_wo_qs',$this->request_uri_wo_qs,true);
		$criteria->compare('request_uri_wo_qs_and_hostname',$this->request_uri_wo_qs_and_hostname,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}