<?php
/* @var $this CiudadController */
/* @var $data Ciudad */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_CIUDAD')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_CIUDAD), array('view', 'id'=>$data->ID_CIUDAD)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOM_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->NOM_CIUDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LINK_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->LINK_CIUDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COMM_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->COMM_CIUDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAGE_ID_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->PAGE_ID_CIUDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIKE_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->LIKE_CIUDAD); ?>
	<br />


</div>