<?php
/* @var $this AmigoController */
/* @var $data Amigo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID_AMIGO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID_AMIGO), array('view', 'id'=>$data->ID_AMIGO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOM_AMIGO')); ?>:</b>
	<?php echo CHtml::encode($data->NOM_AMIGO); ?>
	<br />


</div>