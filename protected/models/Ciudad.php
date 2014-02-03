<?php

/**
 * This is the model class for table "ciudad".
 *
 * The followings are the available columns in table 'ciudad':
 * @property integer $ID_CIUDAD
 * @property string $NOM_CIUDAD
 * @property string $LINK_CIUDAD
 * @property string $COMM_CIUDAD
 * @property string $PAGE_ID_CIUDAD
 * @property integer $LIKE_CIUDAD
 *
 * The followings are the available model relations:
 * @property Visita[] $visitas
 */ 
class Ciudad extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'ciudad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
	//	return array( array('NOM_CIUDAD, LINK_CIUDAD, COMM_CIUDAD, PAGE_ID_CIUDAD, LIKE_CIUDAD', 'required'), array('LIKE_CIUDAD', 'numerical', 'integerOnly' => true), array('NOM_CIUDAD', 'length', 'max' => 50), array('LINK_CIUDAD', 'length', 'max' => 200), array('COMM_CIUDAD', 'length', 'max' => 300), array('PAGE_ID_CIUDAD', 'length', 'max' => 10),
		return array( 
			array('COMM_CIUDAD', 'length', 'max' => 300), 
			array('NOM_CIUDAD', 'required', 'message'=>'<strong>¡Error!</strong>: El nombre de la ciudad no puede estar vacío'),
			array('NOM_CIUDAD', 'length', 'max'=>50),
			array('NOM_CIUDAD', 'unique', 'message'=>'<strong>{value}</strong> ya existe en el sistema'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_CIUDAD, NOM_AMIGO', 'safe', 'on'=>'search'),
		
		// The following rule is used by search().
		// @todo Please remove those attributes that should not be searched.
		array('ID_CIUDAD, NOM_CIUDAD, LINK_CIUDAD, COMM_CIUDAD, PAGE_ID_CIUDAD, LIKE_CIUDAD', 'safe', 'on' => 'search'), );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array('visitas' => array(self::HAS_MANY, 'Visita', 'ID_CIUDAD'), );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array('ID_CIUDAD' => 'Id Ciudad', 'NOM_CIUDAD' => 'Nom Ciudad', 'LINK_CIUDAD' => 'Link Ciudad', 'COMM_CIUDAD' => 'Comm Ciudad', 'PAGE_ID_CIUDAD' => 'Page Id Ciudad', 'LIKE_CIUDAD' => 'Like Ciudad', );
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria -> compare('ID_CIUDAD', $this -> ID_CIUDAD);
		$criteria -> compare('NOM_CIUDAD', $this -> NOM_CIUDAD, true);
		$criteria -> compare('LINK_CIUDAD', $this -> LINK_CIUDAD, true);
		$criteria -> compare('COMM_CIUDAD', $this -> COMM_CIUDAD, true);
		$criteria -> compare('PAGE_ID_CIUDAD', $this -> PAGE_ID_CIUDAD, true);
		$criteria -> compare('LIKE_CIUDAD', $this -> LIKE_CIUDAD);

		return new CActiveDataProvider($this, array('criteria' => $criteria, ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ciudad the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function buscaComentariosCiudad() {
		// session_start(); 
		// $id_ciudad = $_SESSION['id'];
		//var_dump($_SESSION);
		
		if(isset($_SESSION['id'])){
			$id = $_SESSION['id'];
		} else {
			$id = 0;
		}
		
		$criteria = new CDbCriteria;

		$criteria -> compare('ID_CIUDAD', $this -> ID_CIUDAD);

		$where = $criteria -> condition;
		$params = $criteria -> params;
		$where = $criteria -> condition = 'ID_CIUDAD = :ciudadId';
		
		if (isset($this -> ID_CIUDAD)) {
			$params = $criteria -> params = array(':ciudadId' => $this -> ID_CIUDAD);
		} else {
			$params = $criteria -> params = array(':ciudadId' => 0);
		}

		$sql = Yii::app() -> db -> createCommand() -> select('*') -> from('visita_amigo') -> where($where, $params) -> text;
		
		$key = "ID_VISITA";
		$sql = "SELECT ID_VISITA, FECHA_VISITA, GROUP_CONCAT(NOM_AMIGO) AS ACOMPANYANTES,
				 LIKE_VISITA, COM_TEXT FROM VISITA_AMIGO T2 
					INNER JOIN VISITA USING (ID_VISITA) 
						INNER JOIN AMIGO USING (ID_AMIGO) 
							INNER JOIN COMENTARIO USING (ID_VISITA) WHERE ID_CIUDAD = ".$id." GROUP BY ID_VISITA";
		// echo $sql;

		return $dataProvider = new CSqlDataProvider($sql, array('params' => $params, 'keyField' => $key, 'pagination' => array('pageSize' => 10, ), ));
	}

}
