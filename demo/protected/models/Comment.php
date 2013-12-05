<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property string $detail
 * @property integer $is_new
 * @property integer $ref_id
 * @property integer $type
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 * @property integer $activity_id
 * @property integer $temple_detail_id
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Activity $activity
 * @property TempleDetail $templeDetail
 * @property Image[] $images
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, detail, is_new, type, create_date, user_id', 'required'),
			array('id, is_new, ref_id, type, user_id, activity_id, temple_detail_id', 'numerical', 'integerOnly'=>true),
			array('detail', 'length', 'max'=>45),
			array('update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, detail, is_new, ref_id, type, create_date, update_date, user_id, activity_id, temple_detail_id', 'safe', 'on'=>'search'),
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
			'activity' => array(self::BELONGS_TO, 'Activity', 'activity_id'),
			'templeDetail' => array(self::BELONGS_TO, 'TempleDetail', 'temple_detail_id'),
			'images' => array(self::HAS_MANY, 'Image', 'comment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'detail' => 'Detail',
			'is_new' => 'Is New',
			'ref_id' => 'Ref',
			'type' => 'Type',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'user_id' => 'User',
			'activity_id' => 'Activity',
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
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('ref_id',$this->ref_id);
		$criteria->compare('type',$this->type);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('activity_id',$this->activity_id);
		$criteria->compare('temple_detail_id',$this->temple_detail_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
