<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<h3>Create Users</h3>

 <?php echo $this->renderPartial('_form', array(
 			'user'=>$user,
 			'user_profile'=>$user_profile,
 			)); ?>