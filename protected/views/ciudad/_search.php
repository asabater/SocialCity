<?php
/* @var $this CiudadController */
/* @var $model Ciudad */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_CIUDAD'); ?>
		<?php echo $form->textField($model,'ID_CIUDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOM_CIUDAD'); ?>
		<?php echo $form->textField($model,'NOM_CIUDAD',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LINK_CIUDAD'); ?>
		<?php echo $form->textField($model,'LINK_CIUDAD',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COMM_CIUDAD'); ?>
		<?php echo $form->textField($model,'COMM_CIUDAD',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PAGE_ID_CIUDAD'); ?>
		<?php echo $form->textField($model,'PAGE_ID_CIUDAD',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LIKE_CIUDAD'); ?>
		<?php echo $form->textField($model,'LIKE_CIUDAD'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->