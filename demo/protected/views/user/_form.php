<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>


	<?php //echo $form->errorSummary(array($user,$user_profile)); ?>

	<?php echo $form->textFieldRow($user,'username',array('class'=>'span3')); ?>
	
	<?php echo $form->passwordFieldRow($user,'password',array('class'=>'span3')); ?>
	
	<?php echo $form->textFieldRow($user,'email',array('class'=>'span3')); ?>
	
	<?php echo $form->radioButtonListInlineRow($user, 'type', 
		array('0.'=>'Admin', '1'=>'Member')); 
	?>
	
	<?php echo $form->dropdownlistRow($user_profile, 'title', 
			array('Mr.'=>'Mr.', 'Mrs.'=>'Mrs.','Ms.'=>'Ms.'),array('prompt'=>'Please Select title')); 
	?>
	
	<?php echo $form->textFieldRow($user_profile,'firstname',array('class'=>'span3')); ?>
	
	<?php echo $form->textFieldRow($user_profile,'lastname',array('class'=>'span3')); ?>
	
	<?php echo $form->fileFieldRow($user_profile,'avatar'); ?>
	<br>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$user->isNewRecord ? 'Create' : 'Save')); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>

<?php $this->endWidget(); ?>
