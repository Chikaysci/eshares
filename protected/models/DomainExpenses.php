<?php

/**
 * This is the model class for table "domain_expenses".
 *
 * The followings are the available columns in table 'domain_expenses':
 * @property integer $ex_id
 * @property string $domain_id
 * @property string $date_spent
 * @property double $amount
 * @property string $description
 * @property integer $added_by
 * @property string $date_added
 */
class DomainExpenses extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domain_expenses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain_id, added_by', 'required'),
			array('added_by', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('domain_id', 'length', 'max'=>20),
			array('date_spent', 'length', 'max'=>100),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ex_id, domain_id, date_spent, amount, description, added_by, date_added', 'safe', 'on'=>'search'),
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
			'ex_id' => 'Ex',
			'domain_id' => 'Domain',
			'date_spent' => 'Date Spent',
			'amount' => 'Amount',
			'description' => 'Description',
			'added_by' => 'Added By',
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

		$criteria->compare('ex_id',$this->ex_id);
		$criteria->compare('domain_id',$this->domain_id,true);
		$criteria->compare('date_spent',$this->date_spent,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('added_by',$this->added_by);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DomainExpenses the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
