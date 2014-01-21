<?php
/* @var $this ComentarioController */
/* @var $model Comentario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_COMENTARIO'); ?>
		<?php echo $form->textField($model,'ID_COMENTARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COM_TEXT'); ?>
		<?php echo $form->textField($model,'COM_TEXT',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_AMIGO'); ?>
		<?php echo $form->textField($model,'ID_AMIGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ID_VISITA'); ?>
		<?php echo $form->textField($model,'ID_VISITA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_COMENTARIO'); ?>
		<?php echo $form->textField($model,'FECHA_COMENTARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COM_LIKEs'); ?>
		<?php echo $form->textField($model,'COM_LIKEs'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->