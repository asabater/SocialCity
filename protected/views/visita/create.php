<?php
$this->breadcrumbs=array(
	'Visitas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Visita','url'=>array('index')),
	array('label'=>'Manage Visita','url'=>array('admin')),
);
?>

<h1>Create Visita</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>