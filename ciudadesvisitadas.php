<?php
Yii::app()->clientScript->registerCoreScript('jquery');
$this->pageTitle=Yii::app()->name . ' - Cuidades Visitadas';
$this->breadcrumbs=array(
	'Ciudades Visitadas',
);

// Acceso a base de datos
$database="socialcitydb";
$user="root";
$password="";
 
// Conexión a la base de datos
mysql_connect("localhost",$user,$password);
@mysql_select_db($database) or die( "Error de conexion");

 
// Consulta a la base de datos
$sentencia="select ID_CIUDAD, NOM_CIUDAD, COMM_CIUDAD from ciudad ";
$result=mysql_query($sentencia);
$num=mysql_numrows($result);
$nom_ciudad=mysql_result($result,$num-1,"NOM_CIUDAD");
$comm_cuidad=mysql_result($result,$num-1,"COMM_CIUDAD");
$id_ciudad=mysql_result($result,$num-1,"ID_CIUDAD");

$sentencia="select LIKE_VISITA, FECHA_VISITA from visita";
$result=mysql_query($sentencia);
$num=mysql_numrows($result);
$fecha_visita=mysql_result($result,$id_ciudad-1,"FECHA_VISITA");
$like_visita=mysql_result($result,$id_ciudad-1,"LIKE_VISITA");
 
// Cierre de la base de datos
mysql_close();
?>

<?php 
if(isset($_POST['like'])){ 
	// Conectarse a la base de datos
	mysql_connect("localhost",$user,$password);
	@mysql_select_db($database) or die( "Error de conexion");
	// Actualizar un registro en la base de datos
	$like_visita=$like_visita+1;
	$sentencia="UPDATE `socialcitydb`.`visita` SET `LIKE_VISITA` = $like_visita WHERE `visita`.`ID_VISITA` = 1";
	$result=mysql_query($sentencia);
	mysql_close();
}
?>

<form action='' method='POST'>
<h1><?php echo $nom_ciudad; ?> visitada el <?php echo $fecha_visita; ?> 
<button class="btn" <input type='submit' name='like'/>+1</button><small><?php echo $like_visita; ?> likes</small>
</h1>

</form>
<?php echo $comm_cuidad; ?>

<br>

</br>

<form action='' method='POST'>
	<textarea class="form-control" name="comentario" style="width:50%; height:70px ;resize:none" placeholder="Escribe un comentario"></textarea>
	<div class="btn-group">
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	    Quien eres <span class="caret"></span>
	  	</button>
	  		<ul class="dropdown-menu" role="menu">
	    		<li><a href="#">Action</a></li>
	    		<li><a href="#">Another action</a></li>
	    		<li><a href="#">Something else here</a></li>
	    		<li class="divider"></li>
	    		<li><a href="#">Separated link</a></li>
	  		</ul>
	</div>
	<br>
		<button class="btn" <input type='submit' name='comentar' />Enviar</button>
	</br>
</form>

<?php 
if(isset($_POST['comentar'])){ 
	echo "El comentario:".$_REQUEST['comentario'];
}
?>
