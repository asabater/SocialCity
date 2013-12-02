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
			array('ID_VISITA_AMIGO, ID_VISITA, ID_AMIGO', 'safe', 'on'=>'search'),
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
			'iDVISITA' => array(self::BELONGS_TO, 'Visita', 'ID_VISITA'),
			'iDAMIGO' => array(self::BELONGS_TO, 'Amigo', 'ID_AMIGO'),
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
