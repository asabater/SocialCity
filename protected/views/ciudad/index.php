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

<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
    // 'model'=>$model,
    'name'=>'Ciudades',
    'id'=>'Ciudades_visitadas',
    // 'value'=>"Introduce el nombre de la ciudad",
    'htmlOptions' => array(
		'class'=>'span9',
		'placeholder' => 'Introduce el nombre de la ciudad',
	),
       'options'=>array(
		'source'=>'js:function(query,process){
    		amigos = [];
   			map = {};
     	 	$.ajax({
       	 		url: "'.$this->createUrl('autocompletaCiudades').'",
       			type: "GET",
       	 		dataType:"json",
       			data: {term: query},
       			success: function(data){
    				$.each(data, function (i, ciudad) {
	        			map[ciudad.label] = ciudad;
	       				ciudades.push(ciudad.label);
   					 });
 					process(ciudades);
    			},
    		});
    	}',
    	'updater'=>'js:function (item) {
    		ciudadSeleccionado = map[item].id;
    		return item;
    	}',
    	'items'=>4,
  ),
)); ?>
