<?php
/* @var $this AmigoController */
/* @var $model Amigo */
/* @var $dataProvider CActiveDataProvider */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Amigos',
);

Yii::app()->clientScript->registerScript('search', "
$('#form').submit(function(){
	$('.search-form').show('slow');
	$('#amigo_id').text($(\"#Autocompleta_amigo\").val());
	$('#amigo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	$('#VisitaAmigo_ID_AMIGO').val('');
	return false;
});
");

?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'form',
	'htmlOptions'=>array('class'=>'well'),
)); ?>
	<legend>Buscador de amigos</legend>
	<fieldset>
		<div class="input-append">
				<?php 
				//$model2=new VisitaAmigo();
				echo $form->hiddenField($model2,'ID_AMIGO');
				//echo CHtml::hiddenField('valorseleccionado','');
  				$this->widget('bootstrap.widgets.TbTypeAhead', array(
				'model'=> $model,
  				'name'=> 'Autocompleta_amigo',
				'attribute' => 'NOM_AMIGO',
				'htmlOptions' => array(
					'class'=>'span7',
					'placeholder' => 'Introduce el nombre de tu amigo',
					'button'=>'search',
				),
    			'options'=>array(
    				'source'=>'js:function(query,process){
    					amigos = [];
   						map = {};
     	 				$.ajax({
       	 					url: "'.$this->createUrl('amigo/autocompletaAmigos').'",
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
    					$(\'#VisitaAmigo_ID_AMIGO\').val(amigoSeleccionado);
    					return item;
    				}',
    				'items'=>10,
  					),
				));
			?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
    			'buttonType'=>'submit',
   				'type'=>'primary',
    			'label'=>'Buscar',
				'icon'=>'icon-search',
    			'htmlOptions'=>array('class'=>'search-button'),
				));
			?>
		</div>
	</fieldset>
<?php $this->endWidget(); ?>

<div class="search-form" style="display:none">
<h1 id="amigo_id"></h1>
<?php 
	$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'amigo-grid',
	'ajaxUpdate' => 'true',
	'template'=>'{items}',
	'dataProvider'=>$model2->buscaVisitasAmigo(),
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
		'value'=>'$data["COM_TEXT"]==null?"<strong>Visita sin comentarios</strong>":substr($data["COM_TEXT"],0,30)."... ".CHtml::link("Leer más", array ("visita/view", "id"=>$data["ID_VISITA"]))',
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
	'emptyText' => 'El amigo buscado no existe o no ha realizado visitas',
));
 ?>
</div>


<?php
	$addform=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'agregaAmigo',
    'type'=>'inline',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions' => array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array('class'=>'well'),
)); ?>
		<legend>Alta de amigos</legend>
		<div class="alert in alert-block alert-success" style="display:none"></div>
		<div class="row-user-single">
			<?php echo $addform->errorSummary($model); ?>
			<?php echo $addform->textField($model,'NOM_AMIGO',array('class'=>'span7','size'=>50,'maxlength'=>50,'placeholder' => 'Introduce el nombre del amigo a agregar',)); ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
							'id'=>'creaAmigo',
							'buttonType'=>'ajaxSubmit',
							'type'=>'primary',
							'icon'=>'icon-plus-sign',
							'url'=>$this -> createUrl('amigo/create'),
							'label'=>'Agrega amigo',
							'ajaxOptions' => array(
									'type'=>'POST',
									'dataType'=>'json',
									'success'=>'function(data) {
										if(data.status=="success"){
										 $(".alert-success").show();
	                         			 $(".alert-success").html("<strong>"+data.amigo+"</strong>" + " ha sido dado de alta correctamente");
	                         			 $("#agregaAmigo")[0].reset();
										 $(".alert-success").fadeOut(4000);
	                        			}
	                         			else{
	                       				 $.each(data, function(key, val) {
	                        			 $(".alert-error").html(val);                                                    
	                        			 $(".alert-error").show();
										 $( "#Amigo_NOM_AMIGO" ).focus(function() {
											$(".alert-error").hide("slow");
											});
	                        			});
	                        			}       
	                        		}',
							)));
			?>
		</div>
<?php $this->endWidget(); ?>
