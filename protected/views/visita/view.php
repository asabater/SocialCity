<?php
$this->breadcrumbs=array(
	'Visitas'=>array('index'),
	$model->ID_VISITA,
);

$this->menu=array(
	array('label'=>'List Visita','url'=>array('index')),
	array('label'=>'Create Visita','url'=>array('create')),
	array('label'=>'Update Visita','url'=>array('update','id'=>$model->ID_VISITA)),
	array('label'=>'Delete Visita','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_VISITA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Visita','url'=>array('admin')),
);
?>

<h1>View Visita #<?php echo $model->ID_VISITA; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID_VISITA',
		'FECHA_VISITA',
		'LIKE_VISITA',
		'ID_CIUDAD',
	),
)); ?>
