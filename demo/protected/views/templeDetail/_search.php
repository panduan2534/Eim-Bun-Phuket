<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	

	<?php echo $form->dropDownlistRow($temple,'district_id',$temple->getDistrictList(),
			array(
				'class'=>'span5',
				'prompt'=>'Select District',
				'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('templeDetail/changeDistrict'),
					'dataType'=>'json',
					'data'=>array('district_id'=>'js:this.value'),
					'beforeSend' => 'function(){
						$("#myajax").addClass("loading");}',
					'complete' => 'function(){
						$("#myajax").removeClass("loading");}',
					'success'=>'function(data) {
					    $("#TempleDetail_sub_district_id").html(data.dropDownSubDistrict);
					 }',
				)
			)); ?>
 

	<?php echo $form->dropDownlistRow($temple,'sub_district_id', empty($temple->district_id)?array():$temple->getSubDistrictList(),
			array(
				'class'=>'span5','maxlength'=>45,
				'prompt'=>'Select Sub District'
				
			)); ?>
			<span id="myajax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
