<?php
/* @var $this CiudadController */
/* @var $dataProvider CActiveDataProvider */

$this -> breadcrumbs = array('Ciudades', );

$this -> menu = array( array('label' => 'Create Ciudad', 'url' => array('create')), array('label' => 'Manage Ciudad', 'url' => array('admin')), );
?>

<script>
	jQuery.throughObject = function(obj) {
		for (var attr in obj) {
			if (attr == 'extract'){
				// alert(obj[attr]);
				$("#CityDescription").html(obj[attr]);
			}
			console.log(attr + ' : ' + obj[attr]);
			if ( typeof obj[attr] === 'object') {
				jQuery.throughObject(obj[attr]);
			}
		}
	}
	function getDesc(city) {
		$.ajax({
		url : "http://es.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exchars=1000&titles=" + city,
		type : 'GET',
		crossDomain : true,
		dataType : 'jsonp',
		success : function(data, textStatus, jqXHR) {
			jQuery.throughObject(data);
		},

		// success : function(wikiCity) {

		// console.log(obj);
		// alert(w);

		// $(w.Attributes).each(function(index, element){
		// alert(element.Value);
		// })
		// },
		error : function() {
			alert('Failed!');
		}
		// beforeSend : setHeader
		});
	}
</script>

<?php $this -> widget('bootstrap.widgets.TbTypeahead', array(
	// 'model'=>$model,
	'name' => 'Ciudades', 'id' => 'Ciudades_visitadas',
	// 'value'=>"Introduce el nombre de la ciudad",
	'htmlOptions' => array('class' => 'span9', 'placeholder' => 'Introduce el nombre de la ciudad', ), 'options' => array('source' => 'js:function(query,process){
    		ciudades = [];
   			map = {};
     	 	$.ajax({
       	 		url: "' . $this -> createUrl('site/autocompletaCiudades') . '",
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
    	}', 'updater' => 'js:function (item) {
    		ciudadSeleccionado = map[item].id;
			// Show information div
			$("#CityInfo").css("display","inline-block");
			
			$("#CityTitle").html("<h2>"+map[item].label+"</h2>");
			$("#Counter").html(map[item].likes);
			$("#CityOpinion").html(map[item].comm);
			getDesc(map[item].label); 
			
    		return item;
    	}', 'items' => 4, ), ));
?>

<div id='CityInfo'>
	<div id='CityTitle'></div>
	<div id="LikeStats">
		<div id="Counter"></div>
	</div>
	<hr>
	<div id="CityDescription"></div>
	<div id="CityOpinion"></div>
</div>
