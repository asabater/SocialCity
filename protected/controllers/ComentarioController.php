<?php

class ComentarioController extends Controller
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
				'actions'=>array('index','view','megusta'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionCreate()
	{
		$id_amigo = $_POST['id_amigo'];
		$com_text = $_POST['com_text'];
		$id_visita = $_POST['id_visita'];
		$fecha_comentario = date('Y-m-d H:i:s');
	
		$comentario = new Comentario;
		
		$comentario->ID_AMIGO = $id_amigo;
		$comentario->COM_TEXT = $com_text;
		$comentario->ID_VISITA = $id_visita;
		//$comentario->ID_COMENTARIO = '400';
		$comentario->FECHA_COMENTARIO = $fecha_comentario;
		$comentario->save();
		
		$fecha_comentario = date('d-m-Y G:i:s', strtotime($fecha_comentario));
		
		$nom_amigo = Amigo::model()->findByPk($id_amigo);
		
		$respuesta['NOM_AMIGO'] = $nom_amigo->NOM_AMIGO;
		//$respuesta['ID_AMIGO'] = $id_amigo;
		$respuesta['COM_TEXT'] = $com_text;
		$respuesta['ID_VISITA'] = $id_visita;
		$respuesta['FECHA_COMENTARIO'] = $fecha_comentario;
		
		//$comentario = Comentario::model()->findByPk($id_comentario);
		//$com_likes = $comentario->COM_LIKEs;
		$respuesta['COM_LIKEs'] = $comentario->COM_LIKEs;
		
		echo json_encode($respuesta);	 
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 
	public function actionMegusta()
	{
		$id_comentario = $_POST['id_comentario'];		
		$comentario = Comentario::model()->findByPk($id_comentario);
		$com_likes = $comentario->COM_LIKEs;
		
		$com_likes = $com_likes + 1;

		$comentario->saveAttributes(array('COM_LIKEs' => $com_likes));
		$respuesta['ID_COMENTARIO']= $comentario->ID_COMENTARIO;
		$respuesta['COM_LIKEs']= $comentario->COM_LIKEs;
		echo json_encode($respuesta);
	} 
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comentario']))
		{
			$model->attributes=$_POST['Comentario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_COMENTARIO));
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Comentario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comentario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comentario']))
			$model->attributes=$_GET['Comentario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	 }
	public function loadModel($id)
	{
		$model=Comentario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comentario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
