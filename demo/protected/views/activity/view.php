<?php
$this->breadcrumbs=array(
	'Activities'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Activity','url'=>array('index')),
	array('label'=>'Create Activity','url'=>array('create')),
	array('label'=>'Update Activity','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Activity','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Activity','url'=>array('admin')),
);
?>

<h1>View Activity #<?php echo $model->id; ?></h1>

<?php $this->widget('ext.editable.EditableDetailView',array(
	'data'=>$model,
	'url' => $this->createUrl('activity/update'),
	'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
	'emptytext'  => 'no value',
	'attributes'=>array(
		'id',
		'topic',
		'detail',
		'start_date',
		'end_date',
		'is_new',
		'ref_id',
		'create_date',
		'update_date',
		'user_id',
		'temple_detail_id',
	),
)); ?>
