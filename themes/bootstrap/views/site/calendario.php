<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/calendar.js', CClientScript::POS_HEAD);
?>
<div class="page-header">

</div>
<div class="row">
		<div class="span9">
			<div id="calendar"></div>
		</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
			var calendar = $('#calendar').calendar();
</script>
