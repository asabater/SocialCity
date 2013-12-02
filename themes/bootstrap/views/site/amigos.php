<?php
/* @var $this SiteController */
/* @var $model Amigo */
/* @var $form TbActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery');
$this->pageTitle=Yii::app()->name . ' - Amigos';
$this->breadcrumbs=array(
	'Amigos',
);
?>

<div class="form">
<?php 
  $model = Amigo::model();
  $form=$this->widget('bootstrap.widgets.TbTypeAhead', array(
	'model'=> $model,
  	'name'=> 'Autocompleta_amigo',
	'attribute' => 'NOM_AMIGO',
	'htmlOptions' => array(
		'class'=>'span9',
		'placeholder' => 'Introduce el nombre de tu amigo',
	),
    'options'=>array(
    	'source'=>'js:function(query,process){
    		amigos = [];
   			map = {};
     	 	$.ajax({
       	 		url: "'.$this->createUrl('site/autocompletaAmigos').'",
       			type: "GET",
       	 		dataType:"json",
       			data: {term: query},
       			success: function(data){
    				$.each(data, function (i, amigo) {
        			map[amigo.label] = amigo;
       				amigos.push(amigo.label);
   					 });
 					process(amigos);
    			},
    		});
    	}',
    	'updater'=>'js:function (item) {
    		amigoSeleccionado = map[item].id;
    		return item;
    	}',
    	'items'=>4,
  ),
));
echo '<button class="btn" type="submit">Buscar</button>'; 
?>
</div> 
<div id="resultados">
	<?php 
		//echo CHtml::hiddenField('user_id');
		//$decode = json_decode($form, true);
		//echo $decode[];
	 ?>
	<!--  Aquí se pintará la tabla con las visitas del amigo seleccionado -->
</div>