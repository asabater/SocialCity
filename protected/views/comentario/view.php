<?php
/* @var $this ComentarioController */
/* @var $model Comentario */

$this->breadcrumbs=array(
	'Comentarios'=>array('index'),
	$model->ID_COMENTARIO,
);

$this->menu=array(
	array('label'=>'List Comentario', 'url'=>array('index')),
	array('label'=>'Create Comentario', 'url'=>array('create')),
	array('label'=>'Update Comentario', 'url'=>array('update', 'id'=>$model->ID_COMENTARIO)),
	array('label'=>'Delete Comentario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_COMENTARIO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comentario', 'url'=>array('admin')),
);
?>

<h1>View Comentario #<?php echo $model->ID_COMENTARIO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_COMENTARIO',
		'COM_TEXT',
		'ID_AMIGO',
		'ID_VISITA',
		'FECHA_COMENTARIO',
		'COM_LIKEs',
	),
)); ?>
