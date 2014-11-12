<?php

/**
 * This is the model class for table "member_equity".
 *
 * The followings are the available columns in table 'member_equity':
 * @property integer $id
 * @property integer $member_id
 * @property string $domain_id
 * @property integer $equity_points
 * @property integer $toupdate
 */
class MemberEquity extends CActiveRecord
{
	
	public $total_equity;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member_equity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, domain_id', 'required'),
			array('member_id, equity_points, toupdate', 'numerical', 'integerOnly'=>true),
			array('domain_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, member_id, domain_id, equity_points, toupdate', 'safe', 'on'=>'search'),
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
				'domain'    => array(self::BELONGS_TO, 'Domain', 'domain_id'),
				'member'    => array(self::BELONGS_TO, 'Members', 'member_id'),
				
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'domain_id' => 'Domain',
			'equity_points' => 'Equity Points',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('domain_id',$this->domain_id,true);
		$criteria->compare('equity_points',$this->equity_points);
		$criteria->compare('toupdate',$this->toupdate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MemberEquity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
