<?php

/**
 * This is the model class for table "visita_amigo".
 *
 * The followings are the available columns in table 'visita_amigo':
 * @property integer $ID_VISITA_AMIGO
 * @property integer $ID_VISITA
 * @property integer $ID_AMIGO
 *
 * The followings are the available model relations:
 * @property Visita $iDVISITA
 * @property Amigo $iDAMIGO
 */
class VisitaAmigo extends CActiveRecord
{
	public $NOM_AMIGO;
	public $FECHA_VISITA;
	public $ID_CIUDAD;
	public $ACOMPANYANTES;
	public $LIKE_VISITA;
	public $FECHA;
	public $GUSTA;
	public $amigobuscado;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'visita_amigo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_VISITA_AMIGO, ID_VISITA, ID_AMIGO', 'required'),
			array('ID_VISITA_AMIGO, ID_VISITA, ID_AMIGO', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_VISITA_AMIGO, ID_VISITA, ID_AMIGO, NOM_AMIGO, FECHA_VISITA, ID_CIUDAD', 'safe', 'on'=>'search'),
			array('amigobuscado', 'safe', 'on'=>'buscaVisitasAmigo'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'FK_Visita_Visitas' => array(self::BELONGS_TO, 'Visita', 'ID_VISITA'),
			'FK_Amigos_Visitas' => array(self::BELONGS_TO, 'Amigo', 'ID_AMIGO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_VISITA_AMIGO' => 'Id Visita Amigo',
			'ID_VISITA' => 'Id Visita',
			'ID_AMIGO' => 'Id Amigo',
		);
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_VISITA_AMIGO',$this->ID_VISITA_AMIGO);
		$criteria->compare('ID_VISITA',$this->ID_VISITA);
		$criteria->compare('ID_AMIGO',$this->ID_AMIGO);
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function buscaVisitasAmigo()
	{
		$criteria = new CDbCriteria;
		
		//$criteria->compare('ID_AMIGO',$this->ID_AMIGO);

		//$where=$criteria->condition;
		//$params=$criteria->params;
		$where=$criteria->condition='ID_AMIGO = :amigoId';
		if (isset($this->ID_AMIGO)){
		$params=$criteria->params=array(':amigoId'=>$this->ID_AMIGO);}
		else{$params=$criteria->params=array(':amigoId'=>0);}
		
		$subSQL=Yii::app()->db->createCommand()
			->select('ID_VISITA')
			->from ('visita_amigo')
			->where ($where,$params)
			->text;
			
		$key="ID_VISITA";
		$sql="SELECT ID_VISITA, FECHA_VISITA, GROUP_CONCAT(NOM_AMIGO) AS ACOMPANYANTES, LIKE_VISITA, COM_TEXT FROM VISITA_AMIGO T2 INNER JOIN VISITA USING (ID_VISITA) INNER JOIN AMIGO USING (ID_AMIGO) INNER JOIN COMENTARIO USING (ID_VISITA) WHERE ID_VISITA IN ($subSQL) GROUP BY ID_VISITA";
			
		return $dataProvider=new CSqlDataProvider($sql, array(
				'params'=>$params,
				'keyField'=>$key,
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VisitaAmigo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
