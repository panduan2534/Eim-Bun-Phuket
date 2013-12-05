<?php 
	$cs=Yii::app()->clientScript;
 	//$cs->registerCSSFile('css/bootstrap.min.css');
 	//$cs->registerCSSFile('css/blueimp-gallery.min.css');
 	//$cs->registerCSSFile('css/jquery.fileupload.css');
 	$cs->registerCSSFile('css/themes/base/jquery.ui.all.css');
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'temple-detail-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<?php echo $form->textFieldRow($temple,'name',array('class'=>'span5','maxlength'=>45)); ?>
	
	<?php 
	$attribute='content';
	$this->widget('ext.redactor.ERedactorWidget',array(
    'model'=>$temple,
    'attribute'=>$attribute,
    'options'=>array(
        'fileUpload'=>Yii::app()->createUrl('templeDetail/fileUpload',array(
            'attr'=>'content'
        )),
        'fileUploadErrorCallback'=>new CJavaScriptExpression(
            'function(obj,json) { alert(json.error); }'
        ),
        'imageUpload'=>Yii::app()->createUrl('templeDetail/imageUpload',array(
            'attr'=>'content'
        )),
        'imageGetJson'=>Yii::app()->createUrl('templeDetail/imageList',array(
            'attr'=>'content'
        )),
        'imageUploadErrorCallback'=>new CJavaScriptExpression(
            'function(obj,json) { alert(json.error); }'
        ),
    ),
));
?>
	<?php //echo $form->textAreaRow($temple,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span5')); ?>

	<?php echo $form->textAreaRow($temple,'address',array('class'=>'span5','maxlength'=>45)); ?>

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

	<br>
	<?php 
	$this->widget('application.extensions.addresspicker.addresspicker', array(
	    'appendAddressString' => ', Phuket',
	    'address' => '#addresspicker',
	    'lat' => '#Map_latitude',
	    'lng' => '#Map_longtitude',
	    'map' => '#map'));
	?>
	<?php echo CHtml::textField('addresspicker', '', array('class'=>'span5', 'maxlength'=>45, 'placeholder'=>'Please enter location')); ?>
	<?php echo $form->textFieldRow($map,'latitude',array('class'=>'span5','maxlength'=>45, 'readOnly'=>'readOnly')); ?>
	<?php echo $form->textFieldRow($map,'longtitude',array('class'=>'span5','maxlength'=>45, 'readOnly'=>'readOnly')); ?>
    <div id="map"></div>
    <div id="legend">You can drag and drop the marker to the correct location</div><br>
   
    <br>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$temple->isNewRecord ? 'Create' : 'Save')); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Reset')); ?>
<?php $this->endWidget(); ?>

