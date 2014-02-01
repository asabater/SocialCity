<!DOCTYPE html>
<html>

<script> 

function nl2br(str) { 
	return str.replace(/\n/g,"<br/>");
} 

$(document).ready(function(){
	$("p").on("click",".like_btn",function(){		
		$.post("/SocialCity/index.php?r=comentario/megusta", 
		{
			id_comentario : $(this).data("id")
		}, 
		function(data) 
		{
			$("#"+data['ID_COMENTARIO']).html(data['COM_LIKEs'] + ' likes <br/><br/>');
		},'json');
    });

	$("#boton_enviar").click(function(){
		if ( $("#com_text").val().length > 0  &&  $("#com_id_amigo").val() != "" ){
			$.post("/SocialCity/index.php?r=comentario/create",
			{
				id_amigo : $("#com_id_amigo").val(),
				com_text : $("#com_text").val(),
				id_visita : <?php echo $ultima_visita->ID_VISITA;?>
			},
			function(data,status){
				$("#comentarios").prepend('<br/>'+data['NOM_AMIGO']+': '+nl2br(data['COM_TEXT'])+
				'<br/>'+data['FECHA_COMENTARIO']+ 
				'<button style=\"background-color:white; border:none; outline-color:white;\" class=\"like_btn\" data-id=\"'+
				data['ID_COMENTARIO']+'\"><img src=\"images/like2_.png\"/></button>'+
				'<span id=\"'+data['ID_COMENTARIO']+'\">0 likes<br/><br/></span>');
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
<body>
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


<textarea class="form-control" id="com_text" type="text" placeholder="Escribe un comentario..." rows="3" style="width: 98%; resize: none;"></textarea>
<p>
<?php $this->widget('bootstrap.widgets.TbButton', array(
	//'buttonType'=>'submit',
	'type'=>'primary',
	'label'=>'Comentar',
	'icon'=>'icon-envelope',
	'htmlOptions'=>array('id'=>'boton_enviar'),
	));
?>
<p id="comentarios">
<?php
	foreach($comentarios as $comentario):
		echo '<br/>'.$this->id_a_nombre($comentario->ID_AMIGO).': ';
		echo nl2br($comentario->COM_TEXT) . '<br/>';
		$fecha_visita = $comentario->FECHA_COMENTARIO;
		echo $fecha_visita = date('d-m-Y G:i:s', strtotime($fecha_visita));?>
		<button style="background-color:white; border:none; outline-color:white;" class="like_btn" data-id="<?php echo $comentario->ID_COMENTARIO;?>"><img src="images/like2_.png"/></button>
		<span id="<?php echo $comentario->ID_COMENTARIO;?>"><?php echo $comentario->COM_LIKEs . ' likes<br/><br/>';?></span>
<?php endforeach;?>
</p>
</p>
</body>
