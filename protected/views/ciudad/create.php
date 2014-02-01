<?php
/* @var $this CiudadController */
/* @var $model Ciudad */

$this->breadcrumbs=array(
	'Ciudades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ciudad', 'url'=>array('index')),
	array('label'=>'Manage Ciudad', 'url'=>array('admin')),
);
?>

<h1>Nueva Ciudad</h1>

 <?php echo $model->ID_CIUDAD?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>