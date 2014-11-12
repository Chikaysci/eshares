<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property integer $member_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $birthday
 * @property string $picture
 * @property string $date_added
 * @property string $username
 * @property string $password
 * @property integer $is_admin
 * @property string $city
 * @property string $country
 * @property string $phone_number
 * @property string $logged_in
 * @property integer $is_active
 * @property integer $incontrib
 * @property double $rate
 * @property integer $notify_task
 * @property string $notify_task_interval
 * @property integer $invited_role
 * @property integer $publish_network
 * @property integer $publish_crowd
 * @property integer $added_by
 * @property string $is_onboarding
 */
class Members extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, email', 'required'),
			array('is_admin, is_active, incontrib, notify_task, invited_role, publish_network, publish_crowd, added_by', 'numerical', 'integerOnly'=>true),
			array('rate', 'numerical'),
			array('firstname, lastname, email, picture, username, password, city, country', 'length', 'max'=>200),
			array('birthday, phone_number', 'length', 'max'=>100),
			array('notify_task_interval', 'length', 'max'=>7),
			array('is_onboarding', 'length', 'max'=>1),
			array('date_added, logged_in', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('member_id, firstname, lastname, email, birthday, picture, date_added, username, password, is_admin, city, country, phone_number, logged_in, is_active, incontrib, rate, notify_task, notify_task_interval, invited_role, publish_network, publish_crowd, added_by, is_onboarding', 'safe', 'on'=>'search'),
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
			'member_id' => 'Member',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'email' => 'Email',
			'birthday' => 'Birthday',
			'picture' => 'Picture',
			'date_added' => 'Date Added',
			'username' => 'Username',
			'password' => 'Password',
			'is_admin' => 'Is Admin',
			'city' => 'City',
			'country' => 'Country',
			'phone_number' => 'Phone Number',
			'logged_in' => 'Logged In',
			'is_active' => 'Is Active',
			'incontrib' => 'Incontrib',
			'rate' => 'Rate',
			'notify_task' => 'Notify Task',
			'notify_task_interval' => 'Notify Task Interval',
			'invited_role' => 'Invited Role',
			'publish_network' => 'Publish Network',
			'publish_crowd' => 'Publish Crowd',
			'added_by' => 'Added By',
			'is_onboarding' => 'Is Onboarding',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('is_admin',$this->is_admin);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('logged_in',$this->logged_in,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('incontrib',$this->incontrib);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('notify_task',$this->notify_task);
		$criteria->compare('notify_task_interval',$this->notify_task_interval,true);
		$criteria->compare('invited_role',$this->invited_role);
		$criteria->compare('publish_network',$this->publish_network);
		$criteria->compare('publish_crowd',$this->publish_crowd);
		$criteria->compare('added_by',$this->added_by);
		$criteria->compare('is_onboarding',$this->is_onboarding,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Members the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
