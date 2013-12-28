<?php
/* @var $this CiudadController */
/* @var $model Ciudad */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ciudad-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NOM_CIUDAD'); ?>
		<?php echo $form->textField($model,'NOM_CIUDAD',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'NOM_CIUDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LINK_CIUDAD'); ?>
		<?php echo $form->textField($model,'LINK_CIUDAD',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'LINK_CIUDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COMM_CIUDAD'); ?>
		<?php echo $form->textField($model,'COMM_CIUDAD',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'COMM_CIUDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PAGE_ID_CIUDAD'); ?>
		<?php echo $form->textField($model,'PAGE_ID_CIUDAD',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PAGE_ID_CIUDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LIKE_CIUDAD'); ?>
		<?php echo $form->textField($model,'LIKE_CIUDAD'); ?>
		<?php echo $form->error($model,'LIKE_CIUDAD'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->