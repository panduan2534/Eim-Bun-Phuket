<?php
Yii::import("xupload.models.XUploadForm");
class TempleDetailController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
				'upload'=>array(
						'class'=>'xupload.actions.XUploadAction',
						'path' =>Yii::app() -> getBasePath() . '/../gallerys',
						'publicPath' => Yii::app() -> getBaseUrl() . '/gallerys',
				),
				'fileUpload'=>array(
		                'class'=>'ext.redactor.actions.FileUpload',
		                'uploadPath'=>Yii::app() -> getBasePath() . '/../files',
		                'uploadUrl'=>Yii::app() -> getBaseUrl() . '/files',
		                'uploadCreate'=>true,
		                'permissions'=>0777,
	            ),
	            'imageUpload'=>array(
		                'class'=>'ext.redactor.actions.ImageUpload',
		                'uploadPath'=>Yii::app() -> getBasePath() . '/../gallerys',
		                'uploadUrl'=>Yii::app() -> getBaseUrl() . '/gallerys',
		                'uploadCreate'=>true,
		                'permissions'=>0777,
	            ),
	            'imageList'=>array(
		                'class'=>'ext.redactor.actions.ImageList',
		                'uploadPath'=>Yii::app() -> getBasePath() . '/../gallerys',
		                'uploadUrl'=>Yii::app() -> getBaseUrl() . '/gallerys',
	            		'uploadCreate'=>true,
	            		'permissions'=>0777,
	            ),
	            
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//$model = new XUploadForm;
		$temple = new TempleDetail;
		$map = new Map;
		//$image = new Image;
		
		$this->performAjaxValidation($temple);
		$this->performAjaxValidation($map);
		if(isset($_POST['TempleDetail']))
		{
			$temple->attributes=$_POST['TempleDetail'];
			$map->attributes=$_POST['Map'];
			
			$valid = $temple->validate();
			$valid = $map->validate() && $valid;
			if($valid){
				$temple->is_new=1;
				$temple->is_public=1;
				$temple->create_date = date('Y-m-d H:i:s');
				$temple->user_id = Yii::app()->user->id;
				if($temple->save(false)){
					$map->temple_detail_id = $temple->id;
					if($map->save(false))
						$this->redirect(array('index'));
				}
			}
		}

		$this->render('create',array(
			'temple'=>$temple,
			'map'=>$map,
			//'image'=>$image,
			//'model' => $model,
		));
	}
	public function actionImageUpload()
	{
		$model = new XUploadForm;
		
		$this->render('upload',array(
		'model' => $model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$temple=new TempleDetail('search');
		$temple->unsetAttributes();  // clear any default values
		if(isset($_GET['TempleDetail']))
			$temple->attributes=$_GET['TempleDetail'];

		$this->render('index',array(
			'temple'=>$temple,
		));
	}
	
	public function actionChangeDistrict()
	{
		$subdistrict = SubDistrict::model()->findAll('district_id=:district_id',
				array(':district_id'=>(int) $_POST['district_id']));
	
		$subdistrict = CHtml::listData($subdistrict,'id','name');
		$dropDownSubDistrict = "<option value=''>Select Sub District</option>";
		foreach($subdistrict as $value=>$name)
			$dropDownSubDistrict .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
	
		echo CJSON::encode(array(
				'dropDownSubDistrict'=>$dropDownSubDistrict,
		));
	}
	
	public function actionSavecoords()
	{
		$temple=new TempleDetail;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TempleDetail']))
		{
			$temple->attributes=$_POST['TempleDetail'];
			$temple->save();
		}
	}
	
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TempleDetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='temple-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
