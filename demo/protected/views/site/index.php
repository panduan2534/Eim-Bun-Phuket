

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<!-- 
<div style="float: middel; width: 50%; border: solid 1px gray; margin:auto; padding: 3px">
 -->
<div class="form-actions">
<h1>Hello</h1>
<?php 
	$imghtml=CHtml::image(Yii::app()->baseUrl."/images/user.png", "", array("style"=>"width:100px;height:100px;"));
	
	echo CHtml::link($imghtml, array('user/index'));	
?>

<?php 
	$imghtml=CHtml::image(Yii::app()->baseUrl."/images/temple.png", "", array("style"=>"width:100px;height:100px;"));
	
	echo CHtml::link($imghtml, array('templeDetail/index'));	
?>

<?php 
	$imghtml=CHtml::image(Yii::app()->baseUrl."/images/event.png", "", array("style"=>"width:100px;height:100px;"));
	
	echo CHtml::link($imghtml, array('activity/index'));	
?>
</div>
<?php
// 	Yii::import('application.extensions.EGMap.*');
//  		$gMap = new EGMap();
// 		$gMap->setWidth(700);
// 		$gMap->setHeight(350);
//  		$gMap->zoom = 13;
//  		$gMap->setCenter(7.895009,98.352184);
//  		// Create GMapInfoWindow
//  		$info_window = new EGMapInfoWindow('<div>test</div>');
//  		// Create marker
//  		$marker = new EGMapMarker(39.721089311812094, 2.91165944519042, array('title' => '"Work Place"'));
//  		$marker->addHtmlInfoWindow($info_window);
//  		$gMap->addMarker($marker);
// 		$gMap->renderMap();
		?>