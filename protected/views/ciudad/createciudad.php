<?php
/* @var $this CiudadController */
/* @var $dataProvider CActiveDataProvider */

$this -> breadcrumbs = array('Nueva Ciudad');

//$this -> menu = array( array('label' => 'Create Ciudad', 'url' => array('create')), array('label' => 'Manage Ciudad', 'url' => array('admin')), );
$model2=new Ciudad();

?>
<?php
$addform=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
   	'id'=>'agregaCiudad',
   	'type'=>'inline',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions' => array(
	'validateOnSubmit'=>true,
),
'htmlOptions'=>array('class'=>'well'),
)); ?>

<legend>Agregar Ciudad</legend>
<?php echo $addform->errorSummary($model); ?>

<?php echo $addform->textField($model,'NOM_CIUDAD',array('id'=>"Ciudad",'class'=>'span4','size'=>300,'maxlength'=>300,'placeholder' => 'Introduce una ciudad',)); ?>
	<legend></legend>
	<div class="alert in alert-block alert-success" style="display:none"></div>
	<div class="row-user-single">
	
<?php echo $addform->hiddenField($model,'LINK_CIUDAD',array('value'=>"es.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exchars=1000&titles=",)); ?>
 
<?php echo $addform->hiddenField($model,'LIKE_CIUDAD',array('value'=>'0',)); ?>

<?php echo $addform->hiddenField($model,'PAGE_ID_CIUDAD',array('value'=>"1000",)); ?>

<?php echo $addform->textArea($model,'COMM_CIUDAD',array('class'=>'span4','size'=>50,'maxlength'=>50,'placeholder' => 'Introduce un comentario',)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
			'id'=>'NOM_CIUDAD',
			'buttonType'=>'ajaxSubmit',
			'type'=>'primary',
			'icon'=>'icon-plus-sign',
			'url'=>$this -> createUrl('ciudad/create'),
			'label'=>'Agrega Ciudad',
			'ajaxOptions' => array(
				'type'=>'POST',
				'dataType'=>'json',
				'success'=>'function(data) {
					if(data.status=="success"){
						$(".alert-success").show();
                        $(".alert-success").html("<strong>"+data.Ciudad+"</strong>" + " ha sido dado de alta correctamente");
                        $("#agregaCiudad")[0].reset();
						$(".alert-success").fadeOut(4000);
						
                    }
                    else{
                     	$.each(data, function(key, val) {
                        	$(".alert-error").html(val);                                                    
                        	$(".alert-error").show();
							$( "#Ciudad_NOM_CIUDAD" ).focus(function() {
								$(".alert-error").hide("slow");
							});
							$(".alert-error").fadeOut(4000);
                        });
                    }      
                }',
		)));
?>
</div>

<?php $this->endWidget(); ?>

 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
 
 <script type="text/javascript">
 $("#Ciudad").autocomplete({
   source: function(request, response) {
       console.log(request.term);
       $.ajax({
           url: "http://es.wikipedia.org/w/api.php",
           dataType: "jsonp",
           data: {
               'action': "opensearch",
               'format': "json",
               'search': request.term,
               'limit': 4
           },
           success: function(data) {
            if (data[1]==""){
            $(".alert-error").show();
            $(".alert-error").html("<strong>"+request.term+"</strong>" + " No es una ciudad válida");
            $(".alert-error").fadeOut(4000);
            }
           
                response(data[1]); 
               // getDesc(request.term); 
           }
       });      
   }
       
});

/*	function getDesc(city) {
		$(".alert-error").show();
		$.ajax({
			url : "http://es.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exchars=1000&titles=" + city,
			type : 'GET',
			crossDomain : true,
			dataType : 'json',
			success : function(data, textStatus, jqXHR) {
				jQuery.throughObject(data);
			},
			error : 
				console.log("Fallo al recuperar info de la wiki en la vista de ciudad")
		});

		
	}*/


</script>
