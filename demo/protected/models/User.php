<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $type
 * @property integer $is_new
 * @property string $create_date
 * @property string $last_login_date
 *
 * The followings are the available model relations:
 * @property Activity[] $activities
 * @property Comment[] $comments
 * @property TempleDetail[] $templeDetails
 * @property UserProfile[] $userProfiles
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public $avatar;
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password,email', 'required'),
			array('email','email'),
			array('type, is_new', 'numerical', 'integerOnly'=>true),
			array('username, email', 'length', 'max'=>45),
			array('password', 'length', 'max'=>10),
			array('last_login_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, type, is_new, create_date, last_login_date, avatar', 'safe', 'on'=>'search'),
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
			'activities' => array(self::HAS_MANY, 'Activity', 'user_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'templeDetails' => array(self::HAS_MANY, 'TempleDetail', 'user_id'),
			'userProfiles' => array(self::HAS_ONE, 'UserProfile', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'type' => 'Type',
			'is_new' => 'Is New',
			'create_date' => 'Create Date',
			//'last_login_date' => 'Last Login Date',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('last_login_date',$this->last_login_date,true);
		
		$criteria->with = array('userProfiles');
		$criteria->together = true;
		$criteria->compare('userProfiles.avatar',$this->avatar,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				//'defaultOrder'=>array('id_post'=>$arrayContents),
// 				'userProfiles.avatar'=>array(
// 						'desc'=>'ID DESC',
// 				),
				'attributes' => array(
						'userProfiles.avatar','*',
				),
			),
			'pagination'=>array(
				'pageSize'=>5,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
