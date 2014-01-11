<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'ID_COMENTARIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COM_TEXT',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'ID_AMIGO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ID_VISITA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COM_LIKEs',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
