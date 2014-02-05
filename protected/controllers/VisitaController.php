<?php

class VisitaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','megusta','visitaPeriodo','nombre_a_id','id_a_nombre'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$ultima_visita = Visita::model()->findByPk($id);
		$ultima_ciudad = Ciudad::model()->findByPk($ultima_visita->ID_CIUDAD);
		$amigos_visita = VisitaAmigo::model()->findAll('ID_VISITA='.$ultima_visita->ID_VISITA);
		$comentarios = Comentario::model()->findAllBySql('select * from comentario where ID_VISITA='.$ultima_visita->ID_VISITA.' order by FECHA_COMENTARIO desc');
		
		$amigos = Amigo::model()->findAllBySql('select * from amigo order by ID_AMIGO asc');
		
		$this->render('index',array(
			'ultima_visita'=>$ultima_visita,
			'ultima_ciudad'=>$ultima_ciudad,
			'amigos_visita'=>$amigos_visita,
			'comentarios'=>$comentarios,
			'amigos'=>$amigos
			));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Visita;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Visita'])){
			$model->attributes=$_POST['Visita'];
			$valid=$model->validate();
			if($valid){
				$model->save();
				// $this->redirect(array('view','id'=>$model->ID_VISITA));
				echo CJSON::encode(array(
						'status'=>'success',
						'visita'=>$model->ID_VISITA
				));		
				foreach ($_POST['VisitaAmigo']['ID_AMIGO'] as $item){
					$sql = "insert into visita_amigo (id_visita, id_amigo) values (".$model->ID_VISITA.", ".$item.")";
					Yii::app()->db->createCommand($sql)->query();
				}		
			} else {
				$error = CActiveForm::validate($model);
				if($error!='[]')
					echo $error;
			}
		}
		Yii::app()->end();
		// $this->render('create',array(
			// 'model'=>$model,
		// ));
	}
	
		/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	// public function actionCreate()
	// {
		// $model=new Amigo;
// 
		// // Uncomment the following line if AJAX validation is needed
		// //$this->performAjaxValidation($model);
// 
		// if(isset($_POST['Amigo']))
		// {
			// $model->attributes=$_POST['Amigo'];
			// $valid=$model->validate();
			// if($valid){
				// $model->save();
				// echo CJSON::encode(array(
						// 'status'=>'success',
						// 'amigo'=>$model->NOM_AMIGO
				// ));
				// Yii::app()->end();
			// }
			// else{
				// $error = CActiveForm::validate($model);
				// if($error!='[]')
					// echo $error;
				// Yii::app()->end();
			// }
		// }
	// }
	public function actionMegusta($id)
	{
		$model=new Visita;
		$vis=$model->findByPk($id);
	
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		$vis->LIKE_VISITA += 1;
		$vis->save();
		echo json_encode($vis->LIKE_VISITA);
		//$this->render('view', array('post' => $post));
		Yii::app()->end();
	}
	
	public function actionVisitaPeriodo()
	{
		if (isset($_GET['from'])) {
			$criteria=new CDbCriteria;
			$desde = ($_GET['from'])*(1000*60*60*24);
			$hasta = ($_GET['to'])*(1000*60*60*24);
			$ini = new DateTime($desde);
			$ini = $ini->format('Y-m-d');
			$fin = new DateTime($hasta);
			$fin = $fin->format('Y-m-d');
			$criteria->addBetweenCondition('FECHA_VISITA',$ini,$fin);
			$dataProvider = new CActiveDataProvider(get_class(Visita::model()), array(
					'criteria'=>$criteria,'pagination'=>false,
			));
			$visitas = $dataProvider->getData();
			$return_array = array();
			foreach($visitas as $visita) {
				$return_array[] = array(
						'id'=>$visita["ID_VISITA"],
						'title'=>$visita["ID_CIUDAD"],
						'url'=>"http://example.com",
						'class'=>"event-important",
						'start'=>$visita["FECHA_VISITA"],
						'end'=>$visita["FECHA_VISITA"],
				);
			}
			echo CJSON::encode($return_array);
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Visita']))
		{
			$model->attributes=$_POST['Visita'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_VISITA));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	 
	public function nombre_a_id($nombre_amigo){
		$amigo = Amigo::model()->find('NOMBRE_AMIGO='.$nombre_amigo);
		return $amigo->ID_AMIGO;
	}
	 
	public function id_a_nombre($id_amigo){
		$amigo = Amigo::model()->findByPk($id_amigo);
		return $amigo->NOM_AMIGO;
	}	
 
	public function actionIndex()
	{
		$ultima_ciudad = Ciudad::model()->findBySql('select * from ciudad order by ID_CIUDAD desc');
		if ($ultima_ciudad!=NULL){
			$ultima_visita = Visita::model()->findBySql('select * from visita where ID_CIUDAD='.$ultima_ciudad->ID_CIUDAD.' order by FECHA_VISITA desc');
			if ($ultima_visita!=NULL){
				$amigos_visita = VisitaAmigo::model()->findAll('ID_VISITA='.$ultima_visita->ID_VISITA);
				$comentarios = Comentario::model()->findAllBySql('select * from comentario where ID_VISITA='.$ultima_visita->ID_VISITA.' order by FECHA_COMENTARIO desc');
				$amigos = Amigo::model()->findAllBySql('select * from amigo order by ID_AMIGO asc');
				$this->render('index',array(
						'ultima_visita'=>$ultima_visita,
						'ultima_ciudad'=>$ultima_ciudad,
						'amigos_visita'=>$amigos_visita,
						'comentarios'=>$comentarios,
						'amigos'=>$amigos
				));
			}else{
				$this->render('index',array(
						'ultima_ciudad'=>$ultima_ciudad,
						'ultima_visita'=>$ultima_visita,
				));
			}
		}else{
			$this->render('index',array(
				'ultima_ciudad'=>$ultima_ciudad,
			));
		}
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Visita('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Visita']))
			$model->attributes=$_GET['Visita'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Visita the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Visita::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Visita $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='visita-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
