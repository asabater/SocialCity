<?php
/* @var $this AmigoController */
/* @var $model Amigo */
echo "hola";
$this->breadcrumbs=array(
	'Amigos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Amigo', 'url'=>array('index')),
	array('label'=>'Manage Amigo', 'url'=>array('admin')),
);
?>

<h1>Create Amigo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

