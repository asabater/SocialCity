<?php
/* @var $this CiudadController */
/* @var $dataProvider CActiveDataProvider */

$this -> breadcrumbs = array('Ciudad', );

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
<input id="Ciudad" class="span4" type="text"  <?php echo $addform->textField($model,'NOM_CIUDAD',array('size'=>50,'maxlength'=>50,'placeholder' => 'Introduce una ciudad',)); ?>
<legend></legend>
<div class="alert in alert-block alert-success" style="display:none"></div>
<div class="row-user-single">

<?php echo $addform->textArea($model,'COMM_CIUDAD',array('class'=>'span4','size'=>50,'maxlength'=>50,'placeholder' => 'Introduce un comentario',)); ?>
<input type="hidden" value="es.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exchars=1000&titles=" <?php echo $addform->textField($model,'LINK_CIUDAD'); ?>
<input type="hidden" value="0" <?php echo $addform->textField($model,'LIKE_CIUDAD'); ?>
<input type="hidden" value="1000" <?php echo $addform->textField($model,'PAGE_ID_CIUDAD'); ?>
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
            $(".alert-error").html("<strong>"+request.term+"</strong>" + " No es una ciudad v��lida");
            $(".alert-error").fadeOut(4000);
            }
           
                response(data[1]);  
           }
       });      
   }
       
});



</script>
