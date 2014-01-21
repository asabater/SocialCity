<?php

class CalendarioController extends Controller
{
	/**
 	* Acción que nos permite ir al calendario
 	*/
	public function actionCalendario() {
		$this->render('calendario');
	}
	
	public function actionVisitaPeriodo()
	{
		if (isset($_GET['from'])) {
			$criteria=new CDbCriteria;
			$desde = $_GET['from']/1000;
			$hasta = $_GET['to']/1000;
			$des = date('Y-m-d',$desde);
			$has = date('Y-m-d',$hasta);
			//$ini = new DateTime($desde);
			//$ini = $ini->format('YYYY-mm-dd');
			//$fin = new DateTime($hasta);
			//$fin = $fin->format('YYYY-mm-dd');
			//date('YYYY-mm-dd', $desde)
			//
			$criteria->addBetweenCondition('FECHA_VISITA',$des,$has);
			$criteria->with = array('FK_Ciudad_Visita');
			$dataProvider = new CActiveDataProvider(get_class(Visita::model()), array(
					'criteria'=>$criteria,'pagination'=>false,
			));
			$visitas = $dataProvider->getData();
			if (!empty($visitas)){
				$return_array = array();
				foreach($visitas as $visita) {
					$return_array[] = array(
							'id'=>$visita["ID_VISITA"],
							'title'=>$visita->FK_Ciudad_Visita->NOM_CIUDAD,
							'url'=>"a",
							'class'=> "event-special",
							'start'=>strtotime($visita["FECHA_VISITA"]).'000',
							'end'=>strtotime($visita["FECHA_VISITA"]).'000'
					);
				}
				$final = array("success"=>'1', "result"=>$return_array);
			}
			else{
				$final = array("success"=>'0', "error"=>"No hay visitas en el periodo indicado");
			}
			
			echo json_encode($final);
			//echo CJSON::encode($return_array);
		}
	}
}