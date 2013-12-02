<?php
/* @var $this AmigoController */
/* @var $model Amigo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID_AMIGO'); ?>
		<?php echo $form->textField($model,'ID_AMIGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOM_AMIGO'); ?>
		<?php echo $form->textField($model,'NOM_AMIGO',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->