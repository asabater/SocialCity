<?php
	$this->breadcrumbs=array(
	'Visitas',);
?>

<?php 
if ($ultima_ciudad!=NULL){
?>
<h3>
<?php 
	echo $ultima_ciudad->NOM_CIUDAD;
	if ($ultima_visita!=NULL){
?>
<script>
				
function nl2br(str) {
	return str.replace(/\n/g,"<br/>");
}

$(document).ready(function(){
	$(".like_visita").click(function(){
		$.get("/SocialCity/index.php?r=visita/megusta",
		{
			id : <?php echo $ultima_visita->ID_VISITA; ?>
		},
		function(data)		
		{
			$("#vis_"+<?php echo $ultima_visita->ID_VISITA; ?>).html(data + ' likes');
		});
	});
	
	$("p").on("click",".like_btn",function(){		
		$.post("/SocialCity/index.php?r=comentario/megusta", 
		{
			id_comentario : $(this).data("id")
		}, 
		function(data) 
		{
			$("#com_"+data['ID_COMENTARIO']).html(' '+data['COM_LIKEs'] + ' likes <br/><br/>');
		},'json');
    });

	$("#boton_enviar").click(function(){
		$("#alerta").hide();
		if ( $("#com_text").val().length > 0  &&  $("#com_id_amigo").val() != "" ){
			$.post("/SocialCity/index.php?r=comentario/create",
			{
				id_amigo : $("#com_id_amigo").val(),
				com_text : $("#com_text").val(),
				id_visita : <?php echo $ultima_visita->ID_VISITA;?>
			},
			function(data,status){
				$("#comentarios").prepend('<br/><b>'+data['NOM_AMIGO']+'</b> '+nl2br(data['COM_TEXT'])+
				'<br/>'+data['FECHA_COMENTARIO']+ 
				' <button style=\"background-color:white; border:none; outline-color:white;\" class=\"like_btn\" data-id=\"'+
				data['ID_COMENTARIO']+'\"><img src=\"images/like2_.png\"/></button>'+
				'<span id=\"com_'+data['ID_COMENTARIO']+'\"> 0 likes<br/><br/></span>');
			},'json');
		}
		else{
			if ($("#com_id_amigo").val() == ""){
				$("#alerta").text('Selecciona quién eres');
				$("#alerta").show(500);
			}else 	if ($("#com_text").val().length == 0 ){
						$("#alerta").text('Escribe un comentario');
						$("#alerta").show(500);
					}
		}
	});
});

function showCustomer(str){
	var xmlhttp;    
	if (str==""){
		document.getElementById("txtHint").innerHTML="";
		return;
	}
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	}
}
</script>
		<?php
			echo ' vistada el ';
			$fecha_visita = $ultima_visita->FECHA_VISITA;	
			echo $fecha_visita = date('d-m-Y', strtotime($fecha_visita));
		?>

			<button style="background-color:white; border:none; outline-color:white;" class="like_visita" data-id="<?php echo $ultima_visita->ID_VISITA;?>"><img src="images/like2_.png"/></button>
			<span id="vis_<?php echo $ultima_visita->ID_VISITA;?>"><?php echo $ultima_visita->LIKE_VISITA . ' likes';?></span>
</h1> 
		<?php
		if ($amigos_visita!=NULL){
?>
<h5>
<?php
			echo 'Con';
			foreach($amigos_visita as $amigo):
				if ($amigos_visita[0] != $amigo){
					if (end($amigos_visita) != $amigo) echo ', ';
					else echo ' y ';
				}else echo ' ';	
				echo $this->id_a_nombre($amigo->ID_AMIGO);
			endforeach;
		}else echo 'Sin amigos'
		?>
</h5>
<h4><br/>Mis detalles personales y anotaciones sobre la ciudad<br/></h4>
		<?php if($ultima_visita->DESC_VISITA!=NULL){
			echo $ultima_visita->DESC_VISITA;
		}else echo 'No se ha insertado ninguna descripción';?>
		
<h4><br/>Comentarios<br/></h4>
		<select name="com_id_amigo" id="com_id_amigo" type="text" onchange="showCustomer(this.value)">
		<option value="">¿Quién eres?</option>
		
<?php	foreach($amigos as $amigo): 
			$i = $amigo->ID_AMIGO;?>
			<option value="<?php echo $i;?>"><?php echo $amigo->NOM_AMIGO ;?></option>
<?php	endforeach;?>
		</select>

		<textarea class="form-control" id="com_text" type="text" placeholder="Escribe un comentario..." rows="3" style="width: 98%; resize: none;"></textarea>
		
		<p>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Comentar',
			'icon'=>'icon-envelope',
			'htmlOptions'=>array('id'=>'boton_enviar'),
			));
		?>
		<span id="alerta"></span>
		<p id="comentarios">
		<?php
			foreach($comentarios as $comentario):?>
<b><?php		echo '<br/>'.$this->id_a_nombre($comentario->ID_AMIGO).' ';?></b>
<?php			echo nl2br($comentario->COM_TEXT) . '<br/>';
				$fecha_visita = $comentario->FECHA_COMENTARIO;
				echo $fecha_visita = date('d-m-Y G:i:s', strtotime($fecha_visita));?>
				<button style="background-color:white; border:none; outline-color:white;" class="like_btn" data-id="<?php echo $comentario->ID_COMENTARIO;?>"><img src="images/like2_.png"/></button>
				<span id="com_<?php echo $comentario->ID_COMENTARIO;?>"><?php echo $comentario->COM_LIKEs.' likes<br/><br/>';?></span>
		<?php endforeach;?>
		</p>
		</p>
<?php
	}else echo '<h6>No tiene visitas</h6>';
}else echo '<h6>No hay ciudades introducidas</h6>';
?>
