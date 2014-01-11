<?php
$this->breadcrumbs=array(
	'Visitas',
);

$this->menu=array(
	array('label'=>'Create Visita','url'=>array('create')),
	array('label'=>'Manage Visita','url'=>array('admin')),
);
?>

<h1>Visitas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
