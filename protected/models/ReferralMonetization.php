<?php

/**
 * This is the model class for table "referral_monetization".
 *
 * The followings are the available columns in table 'referral_monetization':
 * @property integer $ref_id
 * @property string $name
 * @property string $login_url
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $website
 * @property integer $status
 * @property string $date_added
 * @property integer $member_id
 */
class ReferralMonetization extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'referral_monetization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_added, member_id', 'required'),
			array('status, member_id', 'numerical', 'integerOnly'=>true),
			array('name, login_url, website', 'length', 'max'=>200),
			array('username, password, email', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ref_id, name, login_url, username, password, email, website, status, date_added, member_id', 'safe', 'on'=>'search'),
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
			'ref_id' => 'Ref',
			'name' => 'Name',
			'login_url' => 'Login Url',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'website' => 'Website',
			'status' => 'Status',
			'date_added' => 'Date Added',
			'member_id' => 'Member',
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

		$criteria->compare('ref_id',$this->ref_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('login_url',$this->login_url,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('member_id',$this->member_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReferralMonetization the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
