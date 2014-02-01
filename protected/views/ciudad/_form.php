<?php
/* @var $this CiudadController */
/* @var $model Ciudad */
/* @var $form CActiveForm */
?>
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
 
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ciudad-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'NOM_CIUDAD'); ?>		 
 		<input id="city" <?php echo $valor=$form->textField($model,'NOM_CIUDAD',array('size'=>50,'maxlength'=>50));?>  		
		<?php echo $form->error($model,'NOM_CIUDAD'); ?>		
	</div>
	
	<div class="row">
		<input type="HIDDEN" value="www.google.es" <?php echo $form->textField($model,'LINK_CIUDAD',array('size'=>60,'maxlength'=>200)); ?>	
	</div>

	<div class="row">
		
		
		<?php echo $form->labelEx($model,'COMM_CIUDAD'); ?>
		<textarea class="span9" <?php echo $form->textField($model,'COMM_CIUDAD',array('size'=>60,'maxlength'=>300)); ?> </textarea>
		<?php echo $form->error($model,'COMM_CIUDAD'); ?>
	</div>

	<div class="row">
		
		<input id="pgid" <?php echo $form->textField($model,'PAGE_ID_CIUDAD',array('size'=>10,'maxlength'=>10)); ?>
		
	</div>

	<div class="row">
		
		<input type="HIDDEN" value="0" <?php echo $form->textField($model,'LIKE_CIUDAD'); ?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

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
            	getAreaMetaInfo_Wikipedia(1773)
                response(data[1]);     
            }
        });      
    }
});

function getAreaMetaInfo_Wikipedia(page_id) {
  $.ajax({
    url: 'http://en.wikipedia.org/w/api.php',
    data: {
      action:'query',
      pageids:page_id,
      format:'json'
    },
    dataType:'jsonp',
    success: function(data) {
      title = data.query.pages[page_id].title.replace(' ','_');
      $.ajax({
        url: 'http://en.wikipedia.org/w/api.php',
        data: {
          action:'parse',
          prop:'text',
          page:title,
          format:'json'
        },
        dataType:'jsonp',
        success: function(data) {
          wikipage = $("<div>"+data.parse.text['*']+"</div>").children('p:first');
          wikipage.find('sup').remove();
          wikipage.find('a').each(function() {
            $(this)
              .attr('href', 'http://en.wikipedia.org'+$(this).attr('href'))
              .attr('target','wikipedia');
          });
          $("#wiki_container").append(wikipage);
          $("#wiki_container").append("<a href='http://en.wikipedia.org/wiki/"+title+"' target='wikipedia'>Read more on Wikipedia</a>");
        }
      });
    }
  });
}

</script>