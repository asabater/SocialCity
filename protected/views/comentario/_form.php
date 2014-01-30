<?php
/* @var $this ComentarioController */
/* @var $model Comentario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comentario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'COM_TEXT'); ?>
		<?php echo $form->textField($model,'COM_TEXT',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'COM_TEXT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_AMIGO'); ?>
		<?php echo $form->textField($model,'ID_AMIGO'); ?>
		<?php echo $form->error($model,'ID_AMIGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ID_VISITA'); ?>
		<?php echo $form->textField($model,'ID_VISITA'); ?>
		<?php echo $form->error($model,'ID_VISITA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_COMENTARIO'); ?>
		<?php echo $form->textField($model,'FECHA_COMENTARIO'); ?>
		<?php echo $form->error($model,'FECHA_COMENTARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COM_LIKEs'); ?>
		<?php echo $form->textField($model,'COM_LIKEs'); ?>
		<?php echo $form->error($model,'COM_LIKEs'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->