<?php
/* @var $this AmigoController */
/* @var $model Amigo */
/* @var $dataProvider CActiveDataProvider */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Amigos',
);

$this->menu=array(
	array('label'=>'Create Amigo', 'url'=>array('create')),
	array('label'=>'Manage Amigo', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.form-actions form').submit(function(){
	$('.search-form').show('slow');
	$('#amigo_id').text($(\"#Autocompleta_amigo\").val());
	$('#amigo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Buscador de amigos</h1>

<div class="form-actions">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'form'
)); ?>
	<fieldset>
		<div class="input-append">
				<?php 
				//$model2=new VisitaAmigo();
				echo $form->hiddenField($model2,'ID_AMIGO');
				//echo CHtml::hiddenField('valorseleccionado','');
  				$this->widget('bootstrap.widgets.TbTypeAhead', array(
				'model'=> $model,
  				'name'=> 'Autocompleta_amigo',
				'attribute' => 'NOM_AMIGO',
				'htmlOptions' => array(
					'class'=>'span7',
					'placeholder' => 'Introduce el nombre de tu amigo',
					'button'=>'search',
				),
    			'options'=>array(
    				'source'=>'js:function(query,process){
    					amigos = [];
   						map = {};
     	 				$.ajax({
       	 					url: "'.$this->createUrl('amigo/autocompletaAmigos').'",
       						type: "GET",
       	 					dataType:"json",
       						data: {term: query},
       						success: function(data){
    							$.each(data, function (i, amigo) {
        						map[amigo.label] = amigo;
       							amigos.push(amigo.label);
   								 });
 								process(amigos);
    						},
    					});
    				}',
    				'updater'=>'js:function (item) {
    					amigoSeleccionado = map[item].id;
    					$(\'#VisitaAmigo_ID_AMIGO\').val(amigoSeleccionado);
    					return item;
    				}',
    				'items'=>4,
  					),
				));
			?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
    			'buttonType'=>'submit',
   				'type'=>'primary',
    			'label'=>'Buscar',
				'icon'=>'search',
    			'htmlOptions'=>array('class'=>'search-button'),
				));
			?>
		</div>
	</fieldset>
<?php $this->endWidget(); ?>
</div> 
<div class="search-form" style="display:none">
<h1 id="amigo_id"></h1>
<?php 
	$this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'amigo-grid',
	'ajaxUpdate' => 'true',
	'template'=>'{items}',
	'dataProvider'=>$model2->buscaVisitasAmigo(),
	'columns'=>array(
		array(
		'name'=>'Fecha de la visita',
		'type'=>'raw',
		'value'=>'CHtml::link($data["FECHA_VISITA"], array ("visita/view", "id"=>$data["ID_VISITA"]))',
		),
		array(
		'name'=>'Visitante',
		'value'=>'CHtml::encode($data["ACOMPANYANTES"])',
		),
		array(
		'name'=>'Comentarios',
		'type'=>'raw',
		'value'=>'substr($data["COM_TEXT"],0,30)."... ".CHtml::link("Leer más", array ("visita/view", "id"=>$data["ID_VISITA"]))',
		),
		array(
		'name'=>'Me gusta',
		'value'=>'CHtml::encode($data["LIKE_VISITA"])',
		),
		array(
		'class'=>'CButtonColumn',
		'template' => '{megusta}',
		'buttons'=>array
		(
				'megusta' => array
				(
						'label' => 'Me gusta',
						'imageUrl' => Yii::app()->baseUrl.'/images/like2.png',
						'ajax' => true,
						'url' => 'Yii::app()->createUrl("visita/megusta", array("id"=>$data["ID_VISITA"]))',
						'options' => array( 'ajax' => array('type' => 'GET', 'url'=>'js:$(this).attr("href")', 'success' => 'js:function(data) { $.fn.yiiGridView.update("#amigo-grid")}') ),
				),
		),
		),
	),
	'emptyText' => 'El amigo buscado no ha realizado visitas',
)); ?>
</div>	


<h1>Alta de amigos</h1>

<?php
	$addform=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'agregaAmigo',
    'type'=>'inline',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
		<?php echo $addform->errorSummary($model); ?>
		<?php echo $addform->textField($model,'NOM_AMIGO',array('class'=>'input-xxlarge','size'=>50,'maxlength'=>50)); ?>
		<?php echo $addform->error($model,'NOM_AMIGO'); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
						'id'=>'creaAmigo',
						'buttonType'=>'ajaxSubmit',
						'type'=>'primary',
						'url'=>$this -> createUrl('amigo/create'),
						'label'=>'Nuevo amigo',
						'ajaxOptions' => array(
								'success' => 'function(data){
                    				alert("El nuevo amigo ha sido creado correctamente");
								}',
                    			'error'=>'function(data) {
           							alert("Ha habido un error en el alta del amigo, por favor inténtelo de nuevo");
        						}',
						)));?>
<?php $this->endWidget(); ?>
