<?php
/* @var $this ComentarioController */
/* @var $data Comentario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_COMENTARIO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_COMENTARIO), array('view', 'id'=>$data->ID_COMENTARIO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COM_TEXT')); ?>:</b>
	<?php echo CHtml::encode($data->COM_TEXT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_AMIGO')); ?>:</b>
	<?php echo CHtml::encode($data->ID_AMIGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_VISITA')); ?>:</b>
	<?php echo CHtml::encode($data->ID_VISITA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_COMENTARIO')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_COMENTARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COM_LIKEs')); ?>:</b>
	<?php echo CHtml::encode($data->COM_LIKEs); ?>
	<br />


</div>