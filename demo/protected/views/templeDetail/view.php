<?php
$this->breadcrumbs=array(
	'Temple Details'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TempleDetail','url'=>array('index')),
	array('label'=>'Create TempleDetail','url'=>array('create')),
	array('label'=>'Update TempleDetail','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete TempleDetail','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TempleDetail','url'=>array('admin')),
);
?>

<h1>View TempleDetail</h1>
<h3><?php echo $model->name; ?></h3>

<?php $this->widget('ext.editable.EditableDetailView',array(
	'data'=>$model,
	'url' => $this->createUrl('templeDetail/update'),
	'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
	'emptytext'  => 'no value',
	'attributes'=>array(
		'name',
		'content',
		'address',
		'district_id',
		'sub_district_id',
		'like_count',
		'view_count',
		'is_public',
		'is_new',
		'create_date',
		'update_date',
		'user_id',
	),
)); ?>

