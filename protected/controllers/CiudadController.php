<?php

class CiudadController extends Controller
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
				'actions'=>array('index','view', 'autocompletaCiudades'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createciudad'),
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
	public function actionView($nom)
	{
	
		$this->render('view',array(
			'model'=>$this->loadModel($nom),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreateciudad()
	{
		$model=new Ciudad;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$this->render('createciudad',array(
			'model'=>$model,
		));
	}
	
	public function actionCreate()
	{
		$model=new Ciudad;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		echo "Ciudad";
		if(isset($_POST['Ciudad']))
		{
			$model->attributes=$_POST['Ciudad'];
			
			$valid=$model->validate();
			if($valid){
				$model->save();
				echo CJSON::encode(array(
						'status'=>'success',
						'Ciudad'=>$model->NOM_CIUDAD
				));
				Yii::app()->end();
			}
			else{
				echo "no valido";
				$error = CActiveForm::validate($model);
				if($error!='[]')
					echo CJON::encode($error);
				Yii::app()->end();
			}
		}
	}
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($nom)
	{
		$model=$this->loadModel($nom);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ciudad']))
		{
			$model->attributes=$_POST['Ciudad'];
			if($model->save())
				$this->redirect(array('view','nom'=>$model->NOM_CIUDAD));
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
	public function actionDelete($nom)
	{
		$this->loadModel($nom)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$models = amigo::model()->findAll(array('order' => 'NOM_AMIGO'));
		$list = CHtml::listData($models, 'ID_AMIGO', 'NOM_AMIGO');
		
		//Construcción del array de amigos necesario para el multidropdown
		$criteria=new CDbCriteria;
		$criteria->alias = "amigos";
		//$criteria->condition = "NOM_AMIGO like '" . $_GET['term'] . "%'";

		$dataProvider = new CActiveDataProvider(get_class(Amigo::model()), array(
				'criteria'=>$criteria,'pagination'=>false,
		));
		$amigos = $dataProvider->getData();

		$return_array = array();
		foreach($amigos as $amigo) {
			$return_array[] = array(
					'label'=>$amigo["NOM_AMIGO"],
					//'value'=>$amigo["NOM_AMIGO"],
					'id'=>$amigo["ID_AMIGO"],
			);
		}
		$amigosJson = CJSON::encode($return_array);
		
		
		$dataProvider=new CActiveDataProvider('Ciudad');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'amigos'=>$list
		));
		

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ciudad('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Ciudad']))
			$model->attributes=$_GET['Ciudad'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ciudad the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($nom)
	{
		$model=Ciudad::model()->findByPk($nom);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ciudad $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ciudad-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAutocompletaCiudades () {
		if (isset($_GET['term'])) {
			$criteria=new CDbCriteria;
			$criteria->alias = "ciudades";
			$criteria->condition = "NOM_CIUDAD like '" . $_GET['term'] . "%'";
	
			$dataProvider = new CActiveDataProvider(get_class(Ciudad::model()), array(
					'criteria'=>$criteria,'pagination'=>false,
			));
			$ciudades = $dataProvider->getData();
	
			$return_array = array();
			foreach($ciudades as $ciudad) {
				$return_array[] = array(
						'label'=>$ciudad["NOM_CIUDAD"],
						'value'=>$ciudad["NOM_CIUDAD"],
						'nom'=>$ciudad["_CIUDAD"],
				);
			}
			echo CJSON::encode($return_array);
			Yii::app()->end();
		}
	}
	
	public function actionCiudades(){
		$this->render('ciudades');
	}
}
