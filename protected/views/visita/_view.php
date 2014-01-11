<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_VISITA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_VISITA),array('view','id'=>$data->ID_VISITA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_VISITA')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_VISITA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIKE_VISITA')); ?>:</b>
	<?php echo CHtml::encode($data->LIKE_VISITA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->ID_CIUDAD); ?>
	<br />


</div>