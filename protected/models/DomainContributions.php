<?php

/**
 * This is the model class for table "domain_contributions".
 *
 * The followings are the available columns in table 'domain_contributions':
 * @property integer $c_id
 * @property integer $c_type_id
 * @property string $domain_id
 * @property integer $member_id
 * @property double $amount
 * @property double $reimbursed
 * @property string $description
 * @property double $cash_payment_received
 * @property string $cash_type
 * @property string $date_added
 */
class DomainContributions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domain_contributions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_type_id, domain_id, member_id, amount', 'required'),
			array('c_type_id, member_id', 'numerical', 'integerOnly'=>true),
			array('amount, reimbursed, cash_payment_received', 'numerical'),
			array('domain_id', 'length', 'max'=>20),
			array('cash_type', 'length', 'max'=>200),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('c_id, c_type_id, domain_id, member_id, amount, reimbursed, description, cash_payment_received, cash_type, date_added', 'safe', 'on'=>'search'),
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
			'c_id' => 'C',
			'c_type_id' => 'C Type',
			'domain_id' => 'Domain',
			'member_id' => 'Member',
			'amount' => 'Amount',
			'reimbursed' => 'Reimbursed',
			'description' => 'Description',
			'cash_payment_received' => 'Cash Payment Received',
			'cash_type' => 'Cash Type',
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

		$criteria->compare('c_id',$this->c_id);
		$criteria->compare('c_type_id',$this->c_type_id);
		$criteria->compare('domain_id',$this->domain_id,true);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('reimbursed',$this->reimbursed);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('cash_payment_received',$this->cash_payment_received);
		$criteria->compare('cash_type',$this->cash_type,true);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DomainContributions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
