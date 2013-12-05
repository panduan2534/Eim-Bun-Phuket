<?php
$this->breadcrumbs=array(
	'Temple Details'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TempleDetail','url'=>array('index')),
	array('label'=>'Create TempleDetail','url'=>array('create')),
	array('label'=>'View TempleDetail','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TempleDetail','url'=>array('admin')),
);
?>

<h1>Update TempleDetail <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>