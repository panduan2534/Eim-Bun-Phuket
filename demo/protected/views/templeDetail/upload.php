<?php
$this->widget('xupload.XUpload', array(
		'url' => Yii::app()->createUrl("templeDetail/upload", array("parent_id" => 1)),
		'model' => $model,
		'attribute' => 'file',
		'multiple' => true,
));
?>