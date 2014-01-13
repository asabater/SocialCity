<?php
/* @var $this CiudadController */
/* @var $model Ciudad */

$this->breadcrumbs=array(
	'Ciudades'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ciudad', 'url'=>array('index')),
	array('label'=>'Manage Ciudad', 'url'=>array('admin')),
);
?>

<h1>Nueva Ciudad</h1>

 
 
 <form action="?r=ciudad/create?" method="get" enctype="application/x-www-form-urlencoded" name="wiki" target="_top">
  <input type="text" id="city" class="span9"/>
 <textarea id="comentario" clas="span9" > </textarea>
  <input id="wiki" name="wiki" type="submit" />
</form>
 
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  
  <script type="text/javascript">
  $("#city").autocomplete({
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
                response(data[1]);     
            }
        });
    }
});

//alert($(#city).val());
  </script>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>