<?php

class AmigoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $amigobuscado;

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
				'actions'=>array('index','view','autocompletaAmigos','visitasRealizadas','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
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
	 * Autocompleta el buscador de amigos
	 * 
	 */
	public function actionAutocompletaAmigos () {
		if (isset($_GET['term'])) {
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
			echo CJSON::encode($return_array);
			Yii::app()->end();
		}
	}
	
	public function actionVisitasRealizadas() {
		if (Yii::app()->request->isAjaxRequest) {
			
			$model = new VisitaAmigo();
			$model->unsetAttributes();
			$model->amigobuscado=$_POST['amigobuscado'];
							
			$dataProvider = $model->buscaVisitasAmigo();
		
			echo $model->amigobuscado;
			$this->renderPartial('index', array('model' => $model, 'dataProvider'=>$dataProvider));
		}
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
		$model=new Amigo;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Amigo']))
		{
			$model->attributes=$_POST['Amigo'];
			$valid=$model->validate();
			if($valid){
				$model->save();
				echo CJSON::encode(array(
						'status'=>'success',
						'amigo'=>$model->NOM_AMIGO
				));
				Yii::app()->end();
			}
			else{
				$error = CActiveForm::validate($model);
				if($error!='[]')
					echo $error;
				Yii::app()->end();
			}
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

		if(isset($_POST['Amigo']))
		{
			$model->attributes=$_POST['Amigo'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID_AMIGO));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Amigo();
		$model2 = new VisitaAmigo('buscaVisitasAmigo');
		$model2->unsetAttributes();  // clear any default values
		
		if(isset($_GET['VisitaAmigo'])){
			$model2->attributes=$_GET['VisitaAmigo'];
		}
		//else{$model2->ID_AMIGO=0;}
			
		$this->render('index',array(
			'model'=>$model,'model2'=>$model2
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Amigo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Amigo']))
			$model->attributes=$_GET['Amigo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Amigo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Amigo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Amigo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='agregaAmigo')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
