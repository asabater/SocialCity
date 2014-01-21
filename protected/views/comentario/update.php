<?php
/* @var $this ComentarioController */
/* @var $model Comentario */

$this->breadcrumbs=array(
	'Comentarios'=>array('index'),
	$model->ID_COMENTARIO=>array('view','id'=>$model->ID_COMENTARIO),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comentario', 'url'=>array('index')),
	array('label'=>'Create Comentario', 'url'=>array('create')),
	array('label'=>'View Comentario', 'url'=>array('view', 'id'=>$model->ID_COMENTARIO)),
	array('label'=>'Manage Comentario', 'url'=>array('admin')),
);
?>

<h1>Update Comentario <?php echo $model->ID_COMENTARIO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>