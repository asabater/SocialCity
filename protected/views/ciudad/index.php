<?php
/* @var $this CiudadController */
/* @var $dataProvider CActiveDataProvider */

$this -> breadcrumbs = array('Ciudades', );

// $this -> menu = array( array('label' => 'Create Ciudad', 'url' => array('create')), array('label' => 'Manage Ciudad', 'url' => array('admin')), );
$modelCiudad=new Ciudad();
$modelVisita=new Visita();
$modelAmigo=new Amigo();
$modelVisitaAmigo= new VisitaAmigo();

Yii::app()->clientScript->registerScript('search', "
$('#form').submit(function(){
	$('.search-form').show('slow');
	//$('#amigo_id').text($(\"#Autocompleta_amigo\").val());
	$('#amigo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	$('#VisitaAmigo_ID_AMIGO').val('');
	return false;
});
");
?>
<?php //var_dump($amigos);?>
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
			error : 
				console.log("Fallo al recuperar info de la wiki en la vista de ciudad")
		});

	}
	function saveSessionIdCiudad(){
		$.ajax({
		  url : '<?php echo Yii::app()->request->baseUrl; ?>/add2session.php',
		  type: 'GET',
		  async: true,
		  dataType : 'jsonp',
		  data: 'id='+$('#Visita_ID_CIUDAD').val(),
	      error : console.log('Failed!'),		  
		  success: function(data, textStatus, jqXHR) {
			jQuery.throughObject(data);
		  }
		});
	}
</script>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'form',
	'htmlOptions'=>array('class'=>'well'),
)); ?>
<legend>Buscador de ciudades</legend>
	<fieldset>
		<div class="input-append">

<?php 

$this -> widget('bootstrap.widgets.TbTypeahead', array(
	// 'model'=>$model,
	'name' => 'Ciudades', 'id' => 'Ciudades_visitadas',
	// 'value'=>"Introduce el nombre de la ciudad",
	'htmlOptions' => array('class' => 'span7', 'placeholder' => 'Introduce el nombre de la ciudad', ), 
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
			$(\'#Visita_ID_CIUDAD\').val(ciudadSeleccionada);
			saveSessionIdCiudad();
			
            // refresh your grid
			$.fn.yiiGridView.update("amigo-grid");
			
			// Show information div
			$("#CityInfo").css("display","inline-block");



			$("#CityTitle").html("<h2>"+map[item].label+"</h2>");
			$("#Counter").html(map[item].likes);
			$("#CityOpinion").html(map[item].comm);
			getDesc(map[item].label); 

    	}', 'items' => 4, ), ));
?> 
<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit',
	'type'=>'primary',
	'label'=>'Buscar',
	'icon'=>'icon-search',
	'htmlOptions'=>array('class'=>'search-button'),
	));
?>
<?php $this->endWidget(); ?>
</fieldset></div>

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
	'dataProvider'=>$modelCiudad->buscaComentariosCiudad(),
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

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'form',
	'htmlOptions'=>array('class'=>'well'),
)); ?>
<div class="alert in alert-block alert-success" style="display:none"></div>
<legend>Alta nueva visita</legend>
	<fieldset>
		<div class="input-append">
<?php echo $form->hiddenField($modelVisita,'ID_CIUDAD'); ?>

<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
 'name'=>'Visita[FECHA_VISITA]',
 'attribute'=>'fecha',
 'value'=>date('Y-m-d'),
 'language' => 'es',
'htmlOptions'=>array(
    'style'=>'height:20px;',
),
 
 'options'=>array(
 'autoSize'=>true,
 'defaultDate'=>date('Y-m-d'),
 'dateFormat'=>'dd-mm-yy',
 'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
 'buttonImageOnly'=>true,
 'buttonText'=>'Fecha',
 'selectOtherMonths'=>true,
 'showAnim'=>'slide',
 'showButtonPanel'=>true,
 'showOn'=>'button',
 'showOtherMonths'=>true,
 'changeMonth' => 'true',
 'changeYear' => 'true',
 ),
 'htmlOptions'=>array(
    'style'=>'height:20px;'),
 )); 
?><br/>
<?php echo $form->textArea($modelVisita,'DESC_VISITA',array('rows'=>6, 'cols'=>50)); ?>
<?php ?>
<?php echo $form->dropDownList($modelVisitaAmigo, 'ID_AMIGO',$amigos, array('multiple' => true)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
				'id'=>'creaVisita',
				'buttonType'=>'ajaxSubmit',
				'type'=>'primary',
				'icon'=>'icon-plus-sign',
				'url'=>$this -> createUrl('visita/create'),
				'label'=>'Agrega visita',
				'ajaxOptions' => array(
						'type'=>'POST',
						'dataType'=>'json',
						'success'=>'function(data) {
							alert("algo")
							if(data.status=="success"){
							 $(".alert-success").show();
                 			 $(".alert-success") .html("<strong>"+data.amigo+"</strong>" + " ha sido dado de alta correctamente");
                 			 $("#agregaAmigo")[0].reset();
							 $(".alert-success").fadeOut(4000);
							 alert("HOOOOOOOLA");
							 // refresh your grid
							 $.fn.yiiGridView.update("amigo-grid");
                			}
                 			else{
                 			 alert("puta fallo");
               				 $.each(data, function(key, val) {
                			 $(".alert-error").html(val);                                                    
                			 $(".alert-error").show();
							 $( "#Amigo_NOM_AMIGO" ).focus(function() {
								$(".alert-error").hide("slow");
								});
                			});
                			}       
                		}',
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
				)));
?>
</div></fieldset>
<?php $this->endWidget(); ?>