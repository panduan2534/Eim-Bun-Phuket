<?php
$this->breadcrumbs=array(
	'Temple Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TempleDetail','url'=>array('index')),
	array('label'=>'Manage TempleDetail','url'=>array('admin')),
);
?>

<h1>Create TempleDetail</h1>

<?php echo $this->renderPartial('_form', array(
		'temple'=>$temple, 
		'map'=>$map,
		//'image'=>$image,
		//'model' => $model
)); 
?>
