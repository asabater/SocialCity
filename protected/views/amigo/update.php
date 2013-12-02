<?php
/* @var $this AmigoController */
/* @var $model Amigo */

$this->breadcrumbs=array(
	'Amigos'=>array('index'),
	$model->ID_AMIGO=>array('view','id'=>$model->ID_AMIGO),
	'Update',
);

$this->menu=array(
	array('label'=>'List Amigo', 'url'=>array('index')),
	array('label'=>'Create Amigo', 'url'=>array('create')),
	array('label'=>'View Amigo', 'url'=>array('view', 'id'=>$model->ID_AMIGO)),
	array('label'=>'Manage Amigo', 'url'=>array('admin')),
);
?>

<h1>Update Amigo <?php echo $model->ID_AMIGO; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>