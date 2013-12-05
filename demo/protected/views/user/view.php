<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

// $this->menu=array(
// 	array('label'=>'List User','url'=>array('index')),
// 	array('label'=>'Create User','url'=>array('create')),
// 	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
// 	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
// 	array('label'=>'Manage User','url'=>array('admin')),
// );
?>

<h2>View User : <?php echo $model->username; ?></h2>

<?php $this->widget('ext.editable.EditableDetailView',array(
	'data'=>$model,
	'url'        => $this->createUrl('user/update'),
	'params'     => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
	'emptytext'  => 'no value',
	'attributes'=>array(
		array(
			'name'=>'userProfiles.avatar',
			'type'=>'html',
			'value'=>($model->userProfiles->avatar != "no_image.png")?
				CHtml::image(Yii::app()->request->baseUrl."/photos/".$model->userProfiles->avatar,"",
				array("style"=>"width:150px;height:100px;")):CHtml::image(Yii::app()->request->baseUrl."/photos/no_image.png","",
				array("style"=>"width:150px;height:100px;")),
		),
		array(
            'name' => 'username',
            'editable' => array(
                'type'       => 'text',
                'inputclass' => 'input-large',
                'emptytext'  => 'No Value',                
                'validate'   => 'function(value) {
                    if(!value) return "User Name is required (client side)"
                }'
            )
		),
		array(
			'name' => 'password',
			'editable' => array(
					'type'       => 'text',
					'inputclass' => 'input-large',
					'emptytext'  => 'No Value', 
					'validate'   => 'function(value) {
	                    if(!value) return "User Name is required (client side)"
	                }'
			)
       	),
		array(
				'name' => 'email',
				'editable' => array(
						'type'       => 'text',
						'inputclass' => 'input-large',
						'emptytext'  => 'No Value',
						'validate'   => 'function(value) {
                    if(!value) return "User Name is required (client side)"
                }'
			)
		),
		array(
				'name' => 'type',
				'editable' => array(
						'type'       => 'select',
						'source'    => Editable::source(array(0 => 'Admin', 1 => 'Member')),
						'emptytext'  => 'No Value',
						'validate'   => 'function(value) {
                    if(!value) return "User Name is required (client side)"
                }'
			)
		),
		
		array(
				'name' => 'userProfiles.title',
				'editable' => array(
						'type'       => 'select',
						'inputclass' => 'input-large',
						'source'    => 	Editable::source(array('Mr.'=>'Mr.', 'Mrs.'=>'Mrs.','Ms.'=>'Ms.')),
						'url'  => array('user/updateProfile'),
						'emptytext'  => 'No Value',
						'validate'   => 'function(value) {
                    if(!value) return "User Name is required (client side)"
                }'
			)
		),
		array(
				'name' => 'userProfiles.firstname',
				'editable' => array(
						'type'       => 'text',
						'inputclass' => 'input-large',
						'url'  => array('user/updateProfile'),
						'emptytext'  => 'No Value',
						'validate'   => 'function(value) {
                    if(!value) return "User Name is required (client side)"
                }'
			)
		),
		array(
				'name' => 'userProfiles.lastname',
				'editable' => array(
						'type'       => 'text',
						'inputclass' => 'input-large',
						'url'  => array('user/updateProfile'),
						'emptytext'  => 'No Value',
						'validate'   => 'function(value) {
                    if(!value) return "User Name is required (client side)"
                }'
			)
		),
		'create_date',
	),
)); ?>
