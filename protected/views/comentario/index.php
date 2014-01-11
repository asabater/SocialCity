<?php
$this->breadcrumbs=array(
	'Comentarios',
);

$this->menu=array(
	array('label'=>'Create Comentario','url'=>array('create')),
	array('label'=>'Manage Comentario','url'=>array('admin')),
);
?>

<h1>Comentarios</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
