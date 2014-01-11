<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'comentario-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'COM_TEXT',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'ID_AMIGO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ID_VISITA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COM_LIKEs',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
