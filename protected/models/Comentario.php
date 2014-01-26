<?php

/**
 * This is the model class for table "comentario".
 *
 * The followings are the available columns in table 'comentario':
 * @property integer $ID_COMENTARIO
 * @property string $COM_TEXT
 * @property integer $ID_AMIGO
 * @property integer $ID_VISITA
 * @property integer $COM_LIKEs
 *
 * The followings are the available model relations:
 * @property Amigo $iDAMIGO
 * @property Visita $iDVISITA
 */
class Comentario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comentario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COM_TEXT, ID_AMIGO, ID_VISITA', 'required'),
			array('ID_AMIGO, ID_VISITA, COM_LIKEs', 'numerical', 'integerOnly'=>true),
			array('COM_TEXT', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID_COMENTARIO, COM_TEXT, ID_AMIGO, ID_VISITA, COM_LIKEs', 'safe', 'on'=>'search'),
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
			'FK_COMENTARIO_AMIGO' => array(self::BELONGS_TO, 'Amigo', 'ID_AMIGO'),
			'FK_COMENTARIO_VISITA' => array(self::BELONGS_TO, 'Visita', 'ID_VISITA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_COMENTARIO' => 'Id Comentario',
			'COM_TEXT' => 'Com Text',
			'ID_AMIGO' => 'Id Amigo',
			'ID_VISITA' => 'Id Visita',
			'COM_LIKEs' => 'Com Likes',
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

		$criteria->compare('ID_COMENTARIO',$this->ID_COMENTARIO);
		$criteria->compare('COM_TEXT',$this->COM_TEXT,true);
		$criteria->compare('ID_AMIGO',$this->ID_AMIGO);
		$criteria->compare('ID_VISITA',$this->ID_VISITA);
		$criteria->compare('COM_LIKEs',$this->COM_LIKEs);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comentario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
