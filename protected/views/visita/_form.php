<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'visita-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'FECHA_VISITA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LIKE_VISITA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ID_CIUDAD',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
