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
		//$criteria->together=true;
		$criteria->with = array('FK_Amigos_Visitas','FK_Visita_Visitas');
		//$criteria->addSearchCondition('iDAMIGO.NOM_AMIGO', $this->ID_AMIGO);

		//$criteria->compare('ID_VISITA_AMIGO',$this->ID_VISITA_AMIGO);
		//$criteria->compare('ID_VISITA',$this->ID_VISITA);
		$criteria->compare('FK_Amigos_Visitas.ID_AMIGO',$this->ID_AMIGO, true);
		$criteria->compare('FK_Amigos_Visitas.NOM_AMIGO',$this->NOM_AMIGO, true);
		$criteria->compare('FK_Visita_Visitas.FECHA_VISITA',$this->FECHA_VISITA, true);
		//$criteria->compare('iDAMIGO.NOM_AMIGO',$this->ID_AMIGO, true);	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function buscaVisitas()
	{
		$subSQL=Yii::app()->db->createCommand()
			->select('ID_VISITA')
			->from ('visita_amigo')
			->where ('ID_AMIGO = 4')
			->text;
		$criteria = new CDbCriteria;
		$criteria->select = array('a.FECHA_VISITA AS FECHA, a.LIKE_VISITA AS GUSTA, GROUP_CONCAT(b.NOM_AMIGO) AS ACOMPANYANTES');
		$criteria->with = array('FK_Visita_Visitas'=>array('together' => true, 'alias'=>'a', 'joinType' => 'INNER JOIN'),'FK_Amigos_Visitas'=>array('together' => true, 'alias'=>'b', 'joinType' => 'INNER JOIN'));
		//$criteria->compare('FK_Amigos_Visitas.ID_AMIGO',$this->ID_AMIGO);
		//$criteria->select = array('', "GROUP_CONCAT(NOM_AMIGO) as acompanyantes", 'ME_GUSTA');
		$criteria->addCondition("t.ID_VISITA in ($subSQL)");
		$criteria->group = 't.ID_VISITA';
		
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
		$sql="SELECT ID_VISITA, FECHA_VISITA, GROUP_CONCAT( DISTINCT NOM_AMIGO) AS ACOMPANYANTES, LIKE_VISITA, COM_TEXT
				FROM (SELECT ID_VISITA, ID_AMIGO
							FROM visita_amigo
								WHERE ID_VISITA IN ($subSQL)) T2
					LEFT JOIN visita USING (ID_VISITA)
					LEFT JOIN amigo USING (ID_AMIGO)
					LEFT JOIN comentario USING (ID_VISITA)
				GROUP BY ID_VISITA";
			
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
