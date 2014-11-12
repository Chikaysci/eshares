<?php

/**
 * This is the model class for table "domain_theoretical_value".
 *
 * The followings are the available columns in table 'domain_theoretical_value':
 * @property string $id
 * @property string $domain_id
 * @property string $domain_name
 * @property double $price
 * @property integer $team
 * @property integer $leads
 * @property integer $social
 * @property integer $social_engagement
 * @property integer $content
 * @property double $total
 * @property string $date_updated
 * @property integer $partners
 * @property integer $monetization
 * @property integer $toupdate
 */
class DomainTheoreticalValue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domain_theoretical_value';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_updated', 'required'),
			array('team, leads, social, social_engagement, content, partners, monetization, toupdate', 'numerical', 'integerOnly'=>true),
			array('price, total', 'numerical'),
			array('domain_id', 'length', 'max'=>20),
			array('domain_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, domain_id, domain_name, price, team, leads, social, social_engagement, content, total, date_updated, partners, monetization, toupdate', 'safe', 'on'=>'search'),
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
			'domain_id' => 'Domain',
			'domain_name' => 'Domain Name',
			'price' => 'Price',
			'team' => 'Team',
			'leads' => 'Leads',
			'social' => 'Social',
			'social_engagement' => 'Social Engagement',
			'content' => 'Content',
			'total' => 'Total',
			'date_updated' => 'Date Updated',
			'partners' => 'Partners',
			'monetization' => 'Monetization',
			'toupdate' => 'Toupdate',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('domain_id',$this->domain_id,true);
		$criteria->compare('domain_name',$this->domain_name,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('team',$this->team);
		$criteria->compare('leads',$this->leads);
		$criteria->compare('social',$this->social);
		$criteria->compare('social_engagement',$this->social_engagement);
		$criteria->compare('content',$this->content);
		$criteria->compare('total',$this->total);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('partners',$this->partners);
		$criteria->compare('monetization',$this->monetization);
		$criteria->compare('toupdate',$this->toupdate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DomainTheoreticalValue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
