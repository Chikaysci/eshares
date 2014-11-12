<?php

/**
 * This is the model class for table "domain_pie_settings".
 *
 * The followings are the available columns in table 'domain_pie_settings':
 * @property integer $s_id
 * @property string $domain_id
 * @property double $non_cash_multiplier
 * @property double $cash_multiplier
 * @property double $commission_rate
 * @property double $royalty_rate
 * @property string $currency
 * @property string $date_added
 */
class DomainPieSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domain_pie_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain_id', 'required'),
			array('non_cash_multiplier, cash_multiplier, commission_rate, royalty_rate', 'numerical'),
			array('domain_id', 'length', 'max'=>20),
			array('currency', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('s_id, domain_id, non_cash_multiplier, cash_multiplier, commission_rate, royalty_rate, currency, date_added', 'safe', 'on'=>'search'),
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
			's_id' => 'S',
			'domain_id' => 'Domain',
			'non_cash_multiplier' => 'Non Cash Multiplier',
			'cash_multiplier' => 'Cash Multiplier',
			'commission_rate' => 'Commission Rate',
			'royalty_rate' => 'Royalty Rate',
			'currency' => 'Currency',
			'date_added' => 'Date Added',
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

		$criteria->compare('s_id',$this->s_id);
		$criteria->compare('domain_id',$this->domain_id,true);
		$criteria->compare('non_cash_multiplier',$this->non_cash_multiplier);
		$criteria->compare('cash_multiplier',$this->cash_multiplier);
		$criteria->compare('commission_rate',$this->commission_rate);
		$criteria->compare('royalty_rate',$this->royalty_rate);
		$criteria->compare('currency',$this->currency,true);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DomainPieSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
