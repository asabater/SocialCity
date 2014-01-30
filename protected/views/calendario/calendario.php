<?php
/* @var $this CalendarioController */

$this->breadcrumbs=array(
		'Calendario',
);
$this->pageTitle=Yii::app()->name;
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/calendar.js', CClientScript::POS_HEAD);
?>
<div class="page-header">
		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
				<button class="btn" data-calendar-nav="today">Hoy</button>
				<button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">Año</button>
				<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
				<button class="btn btn-warning" data-calendar-view="week">Semana</button>
				<button class="btn btn-warning" data-calendar-view="day">Dia</button>
			</div>
		</div>
		
		<h3></h3>
</div>
<div class="row">
		<div class="span9">
			<div id="calendar"></div>
		</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/underscore-min.js"></script>
<script type="text/javascript" src="js/language/es-ES.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jstz.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
	var calendar = $('#calendar').calendar({language: 'es-ES'},{events_source: 'index.php?r=calendario/visitaPeriodo'});
</script>
