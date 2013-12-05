<?php

/**
 * This is the model class for table "activity".
 *
 * The followings are the available columns in table 'activity':
 * @property integer $id
 * @property string $topic
 * @property string $detail
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_new
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 * @property integer $temple_detail_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property TempleDetail $templeDetail
 * @property Comment[] $comments
 * @property Image[] $images
 */
class Activity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'activity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic, detail, start_date, end_date,', 'required'),
			array('is_new, user_id, temple_detail_id', 'numerical', 'integerOnly'=>true),
			
			array('topic, create_date, update_date', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, topic, detail, start_date, end_date, is_new, create_date, update_date, user_id, temple_detail_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'templeDetail' => array(self::BELONGS_TO, 'TempleDetail', 'temple_detail_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'activity_id'),
			'images' => array(self::HAS_MANY, 'Image', 'activity_id'),
		);
	}
	public function beforeSave()
	{
		$this->start_date = date('Y-m-d', strtotime( $this->start_date));
		$this->end_date = date('Y-m-d', strtotime( $this->end_date));
		return parent::beforeSave();
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'topic' => 'Topic',
			'detail' => 'Detail',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'is_new' => 'Is New',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'user_id' => 'User',
			'temple_detail_id' => 'Temple Detail',
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
		$criteria->compare('topic',$this->topic,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('is_new',$this->is_new);
		
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('temple_detail_id',$this->temple_detail_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Activity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
