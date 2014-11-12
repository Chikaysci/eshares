<?php

/**
 * This is the model class for table "domain_team_settings".
 *
 * The followings are the available columns in table 'domain_team_settings':
 * @property integer $s_id
 * @property string $domain_id
 * @property integer $member_id
 * @property double $crowd_percentage
 * @property string $date_added
 */
class DomainTeamSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'domain_team_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain_id, member_id', 'required'),
			array('member_id', 'numerical', 'integerOnly'=>true),
			array('crowd_percentage', 'numerical'),
			array('domain_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('s_id, domain_id, member_id, crowd_percentage, date_added', 'safe', 'on'=>'search'),
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
			'member_id' => 'Member',
			'crowd_percentage' => 'Crowd Percentage',
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
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('crowd_percentage',$this->crowd_percentage);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DomainTeamSettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
