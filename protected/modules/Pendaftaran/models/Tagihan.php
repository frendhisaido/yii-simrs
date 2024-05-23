<?php

/**
 * This is the model class for table "tagihan".
 *
 * The followings are the available columns in table 'tagihan':
 * @property integer $id
 * @property integer $pasien_id
 * @property integer $created_by
 * @property integer $pendaftaran_id
 *
 * The followings are the available model relations:
 * @property ObatTagihan[] $obatTagihans
 * @property Users $createdBy
 * @property Pasien $pasien
 * @property Pendaftaran $pendaftaran
 * @property TindakanTagihan[] $tindakanTagihans
 */
class Tagihan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tagihan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pasien_id, created_by, pendaftaran_id', 'required'),
			array('pasien_id, created_by, pendaftaran_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pasien_id, created_by, pendaftaran_id', 'safe', 'on'=>'search'),
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
			'obatTagihans' => array(self::HAS_MANY, 'ObatTagihan', 'tagihan_id'),
			'createdBy' => array(self::BELONGS_TO, 'Users', 'created_by'),
			'pasien' => array(self::BELONGS_TO, 'Pasien', 'pasien_id'),
			'pendaftaran' => array(self::BELONGS_TO, 'Pendaftaran', 'pendaftaran_id'),
			'tindakanTagihans' => array(self::HAS_MANY, 'TindakanTagihan', 'tagihan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pasien_id' => 'Pasien',
			'created_by' => 'Created By',
			'pendaftaran_id' => 'Pendaftaran',
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
		$criteria->compare('pasien_id',$this->pasien_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('pendaftaran_id',$this->pendaftaran_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tagihan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
