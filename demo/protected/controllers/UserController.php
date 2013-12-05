<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';	

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
		$user=new User;
		$user_profile=new UserProfile;
	
		if(isset($_POST['User']))
		{
			// define avatar path
			$path =Yii::getPathOfAlias('webroot').'/photos/';
			
			$user->attributes = $_POST['User'];
			$user_profile->attributes = $_POST['UserProfile'];
			
			// check validate
			$valid = $user->validate();
			$valid = $user_profile->validate() && $valid;
			
			if($valid)
			{
				$user->is_new=1;
				$user->password=md5($user->password);
				$user->create_date = date('Y-m-d H:i:s');
				$user->save(false);
				
				if($image = CUploadedFile::getInstance($user_profile,'avatar'))
				{
					// generate file name from research title
					$filename = $user->username.'.'.$image->getExtensionName();
					$image->saveAs($path.$filename);
				}
				else
				{
					$filename = 'no_image.png';
				}
				$user_profile->user_id=$user->id;
				$user_profile->avatar=$filename;
				if($user_profile->save(false))
					$this->redirect(array('index'));
			}	
		}
		$this->render('create',array(
			'user'=>$user,
			'user_profile'=>$user_profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		Yii::import('ext.editable.EditableSaver'); //or you can add import 'ext.editable.*' to config
 		$es1 = new EditableSaver('User');  // 'User' is classname of model to be updated
 		$es1->update();
	}
	public function actionUpdateProfile()
	{
		Yii::import('ext.editable.EditableSaver'); //or you can add import 'ext.editable.*' to config
		$es2 = new EditableSaver('UserProfile');
		$es2->update();
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
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];
		
		$this->render('index',array(
				'model'=>$model,
		));
	}
	
	public function actionTest()
	{
	
		$commands = User::model()->findAll();
		$cmdlist = array();
	
		if( $commands != '0'){
			foreach( $commands as $item )
			{
				$object = array();
				$object ['id'] = $item->id;
				$object ['username'] = $item->username;
				$object ['email'] = $item->email;
				$object ['type'] = $item->type;
				$cmdlist[] = $object;
			}
			$arr['command'] = $cmdlist;
		}
	
		header('Content-type: application/json');
		echo json_encode($arr);
		Yii::app()->end();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
