<?php

/**
 * This is the model class for table "temple_detail".
 *
 * The followings are the available columns in table 'temple_detail':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $address
 * @property string $district_id
 * @property string $sub_district_id
 * @property integer $like_count
 * @property integer $view_count
 * @property integer $is_public
 * @property integer $is_new
 * @property string $create_date
 * @property string $update_date
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property Comment[] $comments
 * @property Image[] $images
 * @property Map[] $maps
 * @property User $user
 */
class TempleDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'temple_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content, address, district_id, sub_district_id', 'required'),
			array('like_count, view_count, is_public, is_new, user_id', 'numerical', 'integerOnly'=>true),
			array('name, district_id, sub_district_id', 'length', 'max'=>45),
			array('update_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, content, address, district_id, sub_district_id, like_count, view_count, is_public, is_new, create_date, update_date, user_id', 'safe', 'on'=>'search'),
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
			'activities' => array(self::HAS_MANY, 'Activity', 'temple_detail_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'temple_detail_id'),
			'images' => array(self::HAS_MANY, 'Image', 'temple_detail_id'),
			'maps' => array(self::HAS_MANY, 'Map', 'temple_detail_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'content' => 'Content',
			'address' => 'Address',
			'district_id' => 'District',
			'sub_district_id' => 'Sub District',
			'like_count' => 'Like Count',
			'view_count' => 'View Count',
			'is_public' => 'Is Public',
			'is_new' => 'Is New',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
			'user_id' => 'User',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('district_id',$this->district_id,true);
		$criteria->compare('sub_district_id',$this->sub_district_id,true);
		$criteria->compare('like_count',$this->like_count);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('is_public',$this->is_public);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TempleDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getDistrictList()
	{
		$list = array();
		$district = District::model()->findAll(array('order'=> 'name'));
		$list = CHtml::listData($district,'id','name');
		return $list;
	}
	public function getSubDistrictList()
	{
		$list = array();
		$sub_district = SubDistrict::model()->findAll(array('order'=> 'name'));
		$list = CHtml::listData($sub_district,'id','name');
		return $list;
	}
}
