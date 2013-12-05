<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property integer $level
 * @property integer $comment_id
 * @property integer $activity_id
 * @property integer $temple_detail_id
 *
 * The followings are the available model relations:
 * @property Comment $comment
 * @property Activity $activity
 * @property TempleDetail $templeDetail
 */
class Image extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, level, comment_id, activity_id, temple_detail_id', 'numerical', 'integerOnly'=>true),
			array('name, path', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, path, level, comment_id, activity_id, temple_detail_id', 'safe', 'on'=>'search'),
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
			'comment' => array(self::BELONGS_TO, 'Comment', 'comment_id'),
			'activity' => array(self::BELONGS_TO, 'Activity', 'activity_id'),
			'templeDetail' => array(self::BELONGS_TO, 'TempleDetail', 'temple_detail_id'),
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
			'path' => 'Path',
			'level' => 'Level',
			'comment_id' => 'Comment',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('comment_id',$this->comment_id);
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
	 * @return Image the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function behaviors()
	{
		return array(
				'preview' => array(
						'class' => 'ext.imageAttachment.ImageAttachmentBehavior',
						// size for image preview in widget
						'previewHeight' => 200,
						'previewWidth' => 300,
						// extension for image saving, can be also tiff, png or gif
						'extension' => 'jpg',
						// folder to store images
						'directory' => Yii::getPathOfAlias('webroot').'/gallerys',
						// url for images folder
						'url' => Yii::app()->request->baseUrl . '/gallerys',
						// image versions
						'versions' => array(
								'small' => array(
										'resize' => array(200, null),
								),
								'medium' => array(
										'resize' => array(800, null),
								)
						)
				),
				'galleryBehavior' => array(
						'class' => 'ext.galleryManager.GalleryBehavior',
						'idAttribute' => 'gallery_id',
						'versions' => array(
								'small' => array(
										'centeredpreview' => array(98, 98),
								),
								'medium' => array(
										'resize' => array(800, null),
								)
						),
						'name' => true,
						'description' => true,
				)
		);
	}
}
