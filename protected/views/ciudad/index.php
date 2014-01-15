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
    		ciudades = [];
   			map = {};
     	 	$.ajax({
       	 		url: "'.$this->createUrl('site/autocompletaCiudades').'",
       			type: "GET",
       	 		dataType:"json",
       			data: {term: query},
       			success: function(data){
       				// alert("asdw");
    				$.each(data, function (i, ciudad) {
    					//alert(ciudad.id);
	        			map[ciudad.label] = ciudad;
	       				ciudades.push(ciudad.label);
   					 });
 					process(ciudades);
    			},
    		});
    	}',
    	'updater'=>'js:function (item) {
    		ciudadSeleccionado = map[item].id;
			eval($("#CityTitle").html("<h2>"+map[item].label+"</h2>"));
			alert(map[item].label);  
    		return item;
    	}',
    	'items'=>4,
  ),
)); ?>


<div id='CityInfo'>
	<div id='CityTitle'></div><div id="NumberLikes">NumberLikes</div>
	<hr>
	<div id="CityDescription"></div>
</div>
