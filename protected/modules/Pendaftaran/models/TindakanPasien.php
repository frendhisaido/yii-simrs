<?php

/**
 * This is the model class for table "tindakan_pasien".
 *
 * The followings are the available columns in table 'tindakan_pasien':
 * @property integer $id
 * @property integer $pendaftaran_id
 * @property integer $tindakan_id
 *
 * The followings are the available model relations:
 * @property Pendaftaran $pendaftaran
 * @property Tindakan $tindakan
 */
class TindakanPasien extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tindakan_pasien';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pendaftaran_id, tindakan_id', 'required'),
			array('pendaftaran_id, tindakan_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pendaftaran_id, tindakan_id', 'safe', 'on'=>'search'),
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
			'pendaftaran' => array(self::BELONGS_TO, 'Pendaftaran', 'pendaftaran_id'),
			'tindakan' => array(self::BELONGS_TO, 'Tindakan', 'tindakan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pendaftaran_id' => 'Pendaftaran',
			'tindakan_id' => 'Tindakan',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('pendaftaran_id',$this->pendaftaran_id);
		$criteria->compare('tindakan_id',$this->tindakan_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TindakanPasien the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
