<?php
class JsonController extends Controller
{
	public function actionCheckLogin($username, $password)
	{
		$user = User::model()->find('username="'.$username.'" and password="'.md5($password).'"');
		if($user!=null){
			$object = array();
			$object ['id'] = $user->id;
			$object ['username'] = $user->username;
			$object ['email'] = $user->email;
			$object ['firstname'] = $user->userProfiles->firstname;
			$object ['type'] = $user->type;
			$object ['message'] = 'Login successful';
		}else{
			$object = array();
			$object ['message'] = 'Username or Password incorrect';
		}
		
			$arr['User'] = $object;
		header('Content-type: application/json');
		echo json_encode($arr);
		Yii::app()->end();
	}
	public function actionGetAllTemple()
	{
	
		$temples = TempleDetail::model()->findAll();
		$cmdlist = array();
	
		if( $temples != '0'){
			foreach( $temples as $temple )
			{
				$object = array();
				$object ['id'] = $temple->id;
				$object ['name'] = $temple->name;
				$object ['content'] = $temple->content;
				$object ['address'] = $temple->address;
				$object ['latitude'] = $temple->maps->latitude;
				$cmdlist[] = $object;
			}
			$arr['temple'] = $cmdlist;
		}
	
		header('Content-type: application/json');
		echo json_encode($arr);
		Yii::app()->end();
	}
	public function actionViewTemple($id)
	{
	
		$temples = TempleDetail::model()->findByPK($id);
		$cmdlist = array();
	
		if( $temples != '0'){
			foreach( $temples as $temple )
			{
				$object = array();
				$object ['id'] = $temple->id;
				$object ['name'] = $temple->name;
				$object ['content'] = $temple->content;
				$object ['address'] = $temple->address;
				$cmdlist[] = $object;
			}
			$arr['temple'] = $cmdlist;
		}
	
		header('Content-type: application/json');
		echo json_encode($arr);
		Yii::app()->end();
	}
	public function actionAllUser()
	{
		$temples = User::model()->findAll();
		$cmdlist = array();
	
		if( $temples != '0'){
			foreach( $temples as $temple )
			{
				$object = array();
				$object ['id'] = $temple->id;
				$object ['username'] = $temple->username;
				$object ['email'] = $temple->email;
				$object ['type'] = $temple->type;
				$object ['is_new'] = $temple->is_new;
				$object ['create_date'] = $temple->create_date;
				$cmdlist[] = $object;
			}
			$arr['temple'] = $cmdlist;
		}
	
		header('Content-type: application/json');
		echo json_encode($arr);
		Yii::app()->end();
	}
	public function actionViewUser($id)
	{
	
		$temple = User::model()->findByPK($id);
		
		$cmdlist = array();
	
		if( $temple != '0'){
			
				$object = array();
				$object ['id'] = $temple->id;
				$object ['username'] = $temple->username;
				$object ['email'] = $temple->email;
				$object ['type'] = $temple->type;
				//$cmdlist[] = $object;
			
			$arr['temple'] = $object;
		}
	
		header('Content-type: application/json');
		echo json_encode($arr);
		Yii::app()->end();
	}
}