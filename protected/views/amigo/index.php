<?php
/* @var $this AmigoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Amigos',
);

$this->menu=array(
	array('label'=>'Create Amigo', 'url'=>array('create')),
	array('label'=>'Manage Amigo', 'url'=>array('admin')),
);
?>

<h1>Amigos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
