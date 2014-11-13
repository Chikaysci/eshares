<?php

/**
 * This is the model class for table "referral_monetization_revenue".
 *
 * The followings are the available columns in table 'referral_monetization_revenue':
 * @property integer $id
 * @property integer $ref_id
 * @property integer $member_id
 * @property string $from
 * @property string $to
 * @property integer $no_of_sales
 * @property double $sale_amount
 * @property string $date_added
 */
class ReferralMonetizationRevenue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'referral_monetization_revenue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_id, member_id, date_added', 'required'),
			array('ref_id, member_id, no_of_sales', 'numerical', 'integerOnly'=>true),
			array('sale_amount', 'numerical'),
			array('from, to', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ref_id, member_id, from, to, no_of_sales, sale_amount, date_added', 'safe', 'on'=>'search'),
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
			'ref_id' => 'Ref',
			'member_id' => 'Member',
			'from' => 'From',
			'to' => 'To',
			'no_of_sales' => 'No Of Sales',
			'sale_amount' => 'Sale Amount',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('ref_id',$this->ref_id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('no_of_sales',$this->no_of_sales);
		$criteria->compare('sale_amount',$this->sale_amount);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReferralMonetizationRevenue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
