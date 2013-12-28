<?php
/* @var $this CiudadController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ciudades',
);

$this->menu=array(
	array('label'=>'Create Ciudad', 'url'=>array('create')),
	array('label'=>'Manage Ciudad', 'url'=>array('admin')),
);
?>

<h1>Ciudades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
