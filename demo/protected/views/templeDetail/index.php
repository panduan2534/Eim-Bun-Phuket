<?php
$this->breadcrumbs=array(
	'Temple Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TempleDetail','url'=>array('index')),
	array('label'=>'Create TempleDetail','url'=>array('create')),
	array('label'=>'Upload Image Temple','url'=>array('imageUpload')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('temple-detail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Temple Details</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'temple'=>$temple,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'temple-detail-grid',
	'dataProvider'=>$temple->search(),
	'filter'=>$temple,
	'columns'=>array(
		'id',
		'name',
		'content',
		'address',
		'district_id',
		'sub_district_id',
		/*
		'like_count',
		'view_count',
		'is_public',
		'is_new',
		'create_date',
		'update_date',
		'user_id',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {delete}'
		),
	),
)); ?>
