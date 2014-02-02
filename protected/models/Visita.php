<?php

/**
 * This is the model class for table "visita".
 *
 * The followings are the available columns in table 'visita':
 * @property integer $ID_VISITA
 * @property string $DESC_VISITA
 * @property string $FECHA_VISITA
 * @property integer $LIKE_VISITA
 * @property integer $ID_CIUDAD
 *
 * The followings are the available model relations:
 * @property Comentario[] $comentarios
 * @property Ciudad $iDCIUDAD
 * @property VisitaAmigo[] $visitaAmigos
 */
class Visita extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'visita';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_CIUDAD', 'required'),
			array('LIKE_VISITA, ID_CIUDAD', 'numerical', 'integerOnly'=>true),
			array('DESC_VISITA', 'length', 'max'=>250),
			array('FECHA_VISITA', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_VISITA, DESC_VISITA, FECHA_VISITA, LIKE_VISITA, ID_CIUDAD', 'safe', 'on'=>'search'),
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
			'comentarios' => array(self::HAS_MANY, 'Comentario', 'ID_VISITA'),
			'FK_Ciudad_Visita' => array(self::BELONGS_TO, 'Ciudad', 'ID_CIUDAD'),
			'visitaAmigos' => array(self::HAS_MANY, 'VisitaAmigo', 'ID_VISITA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_VISITA' => 'Id Visita',
			'DESC_VISITA' => 'Desc Visita',
			'FECHA_VISITA' => 'Fecha Visita',
			'LIKE_VISITA' => 'Like Visita',
			'ID_CIUDAD' => 'Id Ciudad',
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

		$criteria->compare('ID_VISITA',$this->ID_VISITA);
		$criteria->compare('DESC_VISITA',$this->DESC_VISITA,true);
		$criteria->compare('FECHA_VISITA',$this->FECHA_VISITA,true);
		$criteria->compare('LIKE_VISITA',$this->LIKE_VISITA);
		$criteria->compare('ID_CIUDAD',$this->ID_CIUDAD);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Visita the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
