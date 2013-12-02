<?php
/* @var $this AmigoController */
/* @var $model Amigo */

$this->breadcrumbs=array(
	'Amigos'=>array('index'),
	$model->ID_AMIGO,
);

$this->menu=array(
	array('label'=>'List Amigo', 'url'=>array('index')),
	array('label'=>'Create Amigo', 'url'=>array('create')),
	array('label'=>'Update Amigo', 'url'=>array('update', 'id'=>$model->ID_AMIGO)),
	array('label'=>'Delete Amigo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID_AMIGO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Amigo', 'url'=>array('admin')),
);
?>

<h1>View Amigo #<?php echo $model->ID_AMIGO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID_AMIGO',
		'NOM_AMIGO',
	),
)); ?>
