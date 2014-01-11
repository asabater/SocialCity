<?php
$this->breadcrumbs=array(
	'Visitas'=>array('index'),
	$model->ID_VISITA=>array('view','id'=>$model->ID_VISITA),
	'Update',
);

$this->menu=array(
	array('label'=>'List Visita','url'=>array('index')),
	array('label'=>'Create Visita','url'=>array('create')),
	array('label'=>'View Visita','url'=>array('view','id'=>$model->ID_VISITA)),
	array('label'=>'Manage Visita','url'=>array('admin')),
);
?>

<h1>Update Visita <?php echo $model->ID_VISITA; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>