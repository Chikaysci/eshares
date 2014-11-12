<?php

/**
 * This is the model class for table "domain".
 *
 * The followings are the available columns in table 'domain':
 * @property integer $domain_id
 * @property string $domain_name
 * @property string $date_added
 * @property string $description
 * @property double $price
 * @property string $title
 * @property string $google_analytics_id
 * @property integer $server_id
 * @property integer $category_id
 * @property integer $builder_id
 * @property integer $framework_id
 * @property string $logo
 * @property integer $monetization_id
 * @property string $google_analytics_code
 * @property string $admin_link
 * @property string $admin_username
 * @property string $admin_password
 * @property string $api_key
 * @property integer $offers
 * @property integer $leads
 * @property integer $services
 * @property string $dns
 * @property string $affiliate_id
 * @property integer $member_id
 * @property integer $promote
 * @property string $project_description
 */
class Domain extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain_name, server_id, category_id, builder_id, framework_id, api_key', 'required'),
			array('server_id, category_id, builder_id, framework_id, monetization_id, offers, leads, services, member_id, promote', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('domain_name', 'length', 'max'=>100),
			array('title, logo, google_analytics_code, admin_link, admin_username, admin_password, dns', 'length', 'max'=>200),
			array('google_analytics_id', 'length', 'max'=>45),
			array('api_key, affiliate_id', 'length', 'max'=>20),
			array('date_added, description, project_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('domain_id, domain_name, date_added, description, price, title, google_analytics_id, server_id, category_id, builder_id, framework_id, logo, monetization_id, google_analytics_code, admin_link, admin_username, admin_password, api_key, offers, leads, services, dns, affiliate_id, member_id, promote, project_description', 'safe', 'on'=>'search'),
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
			'domain_id' => 'Domain',
			'domain_name' => 'Domain Name',
			'date_added' => 'Date Added',
			'description' => 'Description',
			'price' => 'Price',
			'title' => 'Title',
			'google_analytics_id' => 'Google Analytics',
			'server_id' => 'Server',
			'category_id' => 'Category',
			'builder_id' => 'Builder',
			'framework_id' => 'Framework',
			'logo' => 'Logo',
			'monetization_id' => 'Monetization',
			'google_analytics_code' => 'Google Analytics Code',
			'admin_link' => 'Admin Link',
			'admin_username' => 'Admin Username',
			'admin_password' => 'Admin Password',
			'api_key' => 'Api Key',
			'offers' => 'Offers',
			'leads' => 'Leads',
			'services' => 'Services',
			'dns' => 'Dns',
			'affiliate_id' => 'Affiliate',
			'member_id' => 'Member',
			'promote' => 'Promote',
			'project_description' => 'Project Description',
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

		$criteria->compare('domain_id',$this->domain_id);
		$criteria->compare('domain_name',$this->domain_name,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('google_analytics_id',$this->google_analytics_id,true);
		$criteria->compare('server_id',$this->server_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('builder_id',$this->builder_id);
		$criteria->compare('framework_id',$this->framework_id);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('monetization_id',$this->monetization_id);
		$criteria->compare('google_analytics_code',$this->google_analytics_code,true);
		$criteria->compare('admin_link',$this->admin_link,true);
		$criteria->compare('admin_username',$this->admin_username,true);
		$criteria->compare('admin_password',$this->admin_password,true);
		$criteria->compare('api_key',$this->api_key,true);
		$criteria->compare('offers',$this->offers);
		$criteria->compare('leads',$this->leads);
		$criteria->compare('services',$this->services);
		$criteria->compare('dns',$this->dns,true);
		$criteria->compare('affiliate_id',$this->affiliate_id,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('promote',$this->promote);
		$criteria->compare('project_description',$this->project_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Domain the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
