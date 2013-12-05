<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'activity-form',
	'enableAjaxValidation'=>false,

)); ?>
	
	<?php echo $form->textFieldRow($event,'topic',array('class'=>'span5','maxlength'=>45)); ?>
	<?php echo $form->textFieldRow($event,'detail',array('class'=>'span5','maxlength'=>45)); ?>
	<?php
		echo $form->labelEx($event,'start_date');
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'attribute'=>'start_date', 
            'model'=>$event,
            'options' => array(
                      'dateFormat'=>'dd-mm-yy', 
						),
    
             )
		);
	?>
	<br>
	<?php
		echo $form->labelEx($event,'end_date');
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'attribute'=>'end_date', 
            'model'=>$event,
            'options' => array(
                      'dateFormat'=>'dd-mm-yy', 
						),
    
             )
		);
	?>
	
	<br>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$event->isNewRecord ? 'Create' : 'Save')); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>

<?php $this->endWidget(); ?>
