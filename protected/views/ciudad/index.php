<?php
/* @var $this CiudadController */
/* @var $dataProvider CActiveDataProvider */

$this -> breadcrumbs = array('Ciudades', );

// $this -> menu = array( array('label' => 'Create Ciudad', 'url' => array('create')), array('label' => 'Manage Ciudad', 'url' => array('admin')), );
$model2=new Ciudad();

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
		$(".search-form").show();
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
			// alert('Failed!');
		}
		// beforeSend : setHeader
		});
	
		$.ajax({
		  url : <?php echo Yii::app()->request->baseUrl; ?>'/add2session.php?id=' + eval($('#Ciudad_ID_CIUDAD').val()),
		  type: 'GET',
		  async: true,
		  dataType : 'jsonp',
		  data: 'id='+$('#Ciudad_ID_CIUDAD').val(),
		  success: function(data, textStatus, jqXHR) {
			jQuery.throughObject(data);
		  error: alert("nooo");
		  },
	      error : function() {
			alert('Failed!');
		  }
		});
	}
</script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'form'
)); ?>
<?php 
echo $form->hiddenField($model2,'ID_CIUDAD');

$this -> widget('bootstrap.widgets.TbTypeahead', array(
	// 'model'=>$model,
	'name' => 'Ciudades', 'id' => 'Ciudades_visitadas',
	// 'value'=>"Introduce el nombre de la ciudad",
	'htmlOptions' => array('class' => 'span9', 'placeholder' => 'Introduce el nombre de la ciudad', ), 
	'options' => array('source' => 'js:function(query,process){
    		ciudades = [];
   			map = {};
     	 	$.ajax({
       	 		url: "'.$this->createUrl('autocompletaCiudades').'",
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
    		ciudadSeleccionada = map[item].id;
			$(\'#Ciudad_ID_CIUDAD\').val(ciudadSeleccionada);
			// Show information div
			$("#CityInfo").css("display","inline-block");

			$("#CityTitle").html("<h2>"+map[item].label+"</h2>");
			$("#Counter").html(map[item].likes);
			$("#CityOpinion").html(map[item].comm);
			getDesc(map[item].label); 

    	}', 'items' => 4, ), ));
?> 
<?php $this->endWidget(); ?>
<div id='CityInfo'>
	<div id='CityTitle'></div>
	<div id="LikeStats">
		<div id="Counter"></div>
	</div>
	<hr>
	<div id="CityDescription"></div>
	<div id="CityOpinion"></div>
</div>
	
<div class="search-form" style="display:none;">
<h1 id="amigo_id"></h1>
<?php 

	
	$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'amigo-grid',
	'ajaxUpdate' => 'true',
	'template'=>'{items}',
	'dataProvider'=>$model2->buscaComentariosCiudad(),
	'columns'=>array(
		array(
		'name'=>'Fecha de la visita',
		'type'=>'raw',
		'value'=>'CHtml::link($data["FECHA_VISITA"], array ("visita/view", "id"=>$data["ID_VISITA"]))',
		),
		array(
		'name'=>'Visitante',
		'value'=>'CHtml::encode($data["ACOMPANYANTES"])',
		),
		array(
		'name'=>'Comentarios',
		'type'=>'raw',
		'value'=>'substr($data["COM_TEXT"],0,30)."... ".CHtml::link("Leer más", array ("visita/view", "id"=>$data["ID_VISITA"]))',
		),
		array(
		'name'=>'Me gusta',
		'value'=>'CHtml::encode($data["LIKE_VISITA"])',
		),
		array(
		'class'=>'CButtonColumn',
		'template' => '{megusta}',
		'buttons'=>array
		(
			'megusta' => array
          	(
            	'label' => 'Me gusta',
            	'imageUrl' => Yii::app()->baseUrl.'/images/like2.png',
				'click'=>"function(){
    				$.fn.yiiGridView.update('amigo-grid', {
       					type:'POST',
        				url:$(this).attr('href'),
        				success:function(data) {
              				$.fn.yiiGridView.update('amigo-grid');
        				}
    				})
    				return false;
 				 }
				",
            	'url' => 'Yii::app()->createUrl("visita/megusta", array("id"=>$data["ID_VISITA"]))',
          	),
		),
		),
	),
	'emptyText' => 'Aún no hay comentarios',
));
 ?>
</div>	
