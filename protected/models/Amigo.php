<?php

/**
 * This is the model class for table "amigo".
 *
 * The followings are the available columns in table 'amigo':
 * @property integer $ID_AMIGO
 * @property string $NOM_AMIGO
 *
 * The followings are the available model relations:
 * @property Comentario[] $comentarios
 * @property VisitaAmigo[] $visitaAmigos
 */
class Amigo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'amigo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('NOM_AMIGO', 'required'),
			array('NOM_AMIGO', 'length', 'max'=>50),
			array('NOM_AMIGO', 'match', 'pattern'=>'/^[a-zA-Z_áéíóúàèñ\s]*$/', 'message'=>'<strong>¡Error!</strong>: El nombre del amigo únicamente puede contener letras'),
			array('NOM_AMIGO', 'unique', 'message'=>'<strong>{value}</strong> ya existe en el sistema'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_AMIGO, NOM_AMIGO', 'safe', 'on'=>'search'),
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
			'comentarios' => array(self::HAS_MANY, 'Comentario', 'ID_AMIGO'),
			'visitaAmigos' => array(self::HAS_MANY, 'VisitaAmigo', 'ID_AMIGO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_AMIGO' => 'Id Amigo',
			'NOM_AMIGO' => 'Nom Amigo',
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
		$criteria->together=true;
		$criteria->with = array('visitaAmigos');

		$criteria->compare('ID_AMIGO',$this->ID_AMIGO);
		$criteria->compare('NOM_AMIGO',$this->NOM_AMIGO,true);
		$criteria->compare('visitaAmigos.ID_AMIGO',$this->ID_AMIGO, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Amigo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
