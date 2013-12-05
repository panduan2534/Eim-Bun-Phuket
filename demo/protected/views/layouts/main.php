<?php Yii::app()->language=Yii::app()->user->getState('language');?>
<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Language" content="th"> 
	<meta http-equiv="content-Type" content="text/html; charset=window-874"> 
	<meta http-equiv="content-Type" content="text/html; charset=tis-620"> 
	<meta name="language" content="en" />
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
			<?php 
			$imghtml=CHtml::image(Yii::app()->baseUrl."/images/logo.png", "Eim-Bun Phuket", array("style"=>"width:300px;height:300px;"));
			
			echo CHtml::link($imghtml, array('site/index'));
			
			//echo CHtml::image(Yii::app()->baseUrl."/images/logo.png","Eim-Bun Phuket", array("style"=>"width:150px;height:100px;")); 
			
			?>
		</div>
	</div><!-- header -->
	<?php if (Yii::app()->user->isAdmin()): ?>
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'User', 'url'=>array('/user')),
				array('label'=>'ManageTemple', 'url'=>array('/templeDetail/index')),
				array('label'=>'ManageEvent', 'url'=>array('/activity/index')),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php endif; ?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
	
	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
