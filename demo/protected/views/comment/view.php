<?php
$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Comment','url'=>array('index')),
	array('label'=>'Create Comment','url'=>array('create')),
	array('label'=>'Update Comment','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Comment','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comment','url'=>array('admin')),
);
?>

<h1>View Comment #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'detail',
		'is_new',
		'ref_id',
		'type',
		'create_date',
		'update_date',
		'user_id',
		'activity_id',
		'temple_detail_id',
	),
)); ?>
