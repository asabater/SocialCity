<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js">
</script>
<script> 

function nl2br(str) { 
	return str.replace(/\n/g,"<br/>");
} 

$(document).ready(function(){
	$('.like_btn').on('click',function() 
    {
        //e.preventDefault();

        var id_comentario = $(this).data("id");

            $.post("/SocialCity/index.php?r=comentario/megusta", 
			{
				id_comentario : id_comentario
			}, 
			function(data) 
            {
				//alert($("#").attr("data-id");
				$("#"+data['ID_COMENTARIO']).text(data['COM_LIKEs']);
            },'json');
    });

	$("#boton_enviar").on('click',function(){
		if ( $("#com_text").val().length > 0  &&  $("#com_id_amigo").val() != "" ){
			$.post("/SocialCity/index.php?r=comentario/create",
			{
				id_amigo : $("#com_id_amigo").val(),
				com_text : $("#com_text").val(),
				id_visita : <?php echo $ultima_visita->ID_VISITA;?>
			},
			function(data,status){
				//alert("Data: " + data['ID_AMIGO'] + data['COM_TEXT'] + data['ID_VISITA'] + data['FECHA_COMENTARIO']+ "\nStatus: " + status);
				$("#comentarios").prepend(data['NOM_AMIGO']+' dijo:<br/>'+nl2br(data['COM_TEXT'])+
				'<br/>'+data['FECHA_COMENTARIO']+
				'<br/>Likes ' + '<span id=\"'+data['ID_COMENTARIO']+'\">'+data['COM_LIKEs']+' </span>'+
				'<button class=\"like_btn\" data-id=\"'+data['ID_COMENTARIO']+'\">+1</button><br/><br/>');
			},'json');
		};
	});
});

function showCustomer(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
//xmlhttp.open("GET","getcustomer.asp?q="+str,true);
//xmlhttp.send();
}
</script>
</head>

<?php
	$this->breadcrumbs=array(
	'Ciudades visitadas',);

	echo $ultima_ciudad->NOM_CIUDAD . ' vistada por ultima vez el ';
	
	$fecha_visita = $ultima_visita->FECHA_VISITA;	
	echo $fecha_visita = date('d-m-Y', strtotime($fecha_visita));
?>

<br/>con 
<?php
	foreach($amigos_visita as $amigo):
		if ($amigos_visita[0] != $amigo){
			if (end($amigos_visita) != $amigo) echo ', ';
			else echo ' y ';
		}else echo ' ';	
		echo $this->id_a_nombre($amigo->ID_AMIGO);
	endforeach;
?>

<br/><br/>Mis detalles personales y anotaciones sobre la ciudad<br/><br/>
<?php
echo $ultima_ciudad->COMM_CIUDAD;
?>

<br/><br/>Comentarios<br/><br/>


<select name="com_id_amigo" id="com_id_amigo" type="text" onchange="showCustomer(this.value)">
<option value="">¿Quién eres?</option>
<?php
	$i = 1;
	foreach($amigos as $amigo): ?>
		<option value="<?php echo $i;?>"><?php echo $amigo->NOM_AMIGO ;?></option>
		<?php $i = $i + 1;
	endforeach;
?>
</select>

<div align="right">
<textarea class="form-control" id="com_text" type="text" placeholder="Introduce tu comentario" rows="3" style="width: 98%; resize: none;"></textarea>
<button id="boton_enviar">Enviar</button>
</div>


<div id="comentarios">
<?php
	foreach($comentarios as $comentario):
		echo $this->id_a_nombre($comentario->ID_AMIGO) . ' dijo:<br/>';
		echo nl2br($comentario->COM_TEXT) . '<br/>';
		$fecha_visita = $comentario->FECHA_COMENTARIO;?> 
		<?php echo $fecha_visita = date('d-m-Y G:i:s', strtotime($fecha_visita)) . '<br/>Likes ';?>
		<span id="<?php echo $comentario->ID_COMENTARIO;?>"><?php echo $comentario->COM_LIKEs . ' ';?></span>
		<button class="like_btn" data-id="<?php echo $comentario->ID_COMENTARIO;?>">+1</button>
		<br/><br/>
<?php	endforeach;
?>
</div id="comentarios">



<?php
/*
$this->breadcrumbs=array(
	'Visitas',
);

$this->menu=array(
	array('label'=>'Create Visita','url'=>array('create')),
	array('label'=>'Manage Visita','url'=>array('admin')),
);
?>

<h1>Visitas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
