<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'itemsCssClass'=>'table table-striped table-bordered table-condensed',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		array(
		'name'=>'userProfiles.avatar',
		'type'=>'html',
		'value'=>'($data->userProfiles->avatar != "no_image.png")?
			CHtml::image(Yii::app()->request->baseUrl."/photos/".$data->userProfiles->avatar,"",
			array("style"=>"width:50px;height:40px;")):CHtml::image(Yii::app()->request->baseUrl."/photos/no_image.png","",
			array("style"=>"width:50px;height:40px;"))',

		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name'=>'username',
			'headerHtmlOptions' => array('style' => 'width: 110px'),
			'editable' => array(
					'url'        => $this->createUrl('user/update'),
					'placement'  => 'right',
					'inputclass' => 'span3',
			)	
		),
		//'password',
		'email',
		array(
			'name'=>'type',
			'value'=>'$data->type?"Member":"Admin"',
		),
		'create_date',
		/*
		'last_login_date',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view} {delete}'
		),
	),
)); ?>
