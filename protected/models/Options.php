<?php

/**
 * This is the model class for table "options".
 *
 * The followings are the available columns in table 'options':
 * @property integer $id
 * @property string $option
 * @property string $value
 * @property string $type
 * @property string $help
 * @property string $option_human
 */
class Options extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Options the static model class
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
		return 'options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option, value', 'required'),
			array('option, value, option_human', 'length', 'max'=>255),
			array('type', 'length', 'max'=>32),
			array('help', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, option, value, type, help, option_human', 'safe', 'on'=>'search'),
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
			'option' => 'Option',
			'value' => 'Value',
			'type' => 'Type',
			'help' => 'Help',
			'option_human' => 'Option Human',
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
		$criteria->compare('option',$this->option,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('help',$this->help,true);
		$criteria->compare('option_human',$this->option_human,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}