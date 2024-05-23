<?php

/**
 * This is the model class for table "pendaftaran".
 *
 * The followings are the available columns in table 'pendaftaran':
 * @property integer $id
 * @property integer $pegawai_id
 * @property integer $pasien_id
 * @property string $tanggal
 *
 * The followings are the available model relations:
 * @property ObatPasien[] $obatPasiens
 * @property Pembayaran[] $pembayarans
 * @property Pasien $pasien
 * @property Pegawai $pegawai
 * @property Tagihan[] $tagihans
 * @property TindakanPasien[] $tindakanPasiens
 */
class Pendaftaran extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pendaftaran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pegawai_id, pasien_id, tanggal', 'required'),
			array('pegawai_id, pasien_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pegawai_id, pasien_id, tanggal', 'safe', 'on'=>'search'),
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
			'obatPasiens' => array(self::HAS_MANY, 'ObatPasien', 'pendaftaran_id'),
			'pembayarans' => array(self::HAS_MANY, 'Pembayaran', 'pendaftaran_id'),
			'pasien' => array(self::BELONGS_TO, 'Pasien', 'pasien_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'tagihans' => array(self::HAS_MANY, 'Tagihan', 'pendaftaran_id'),
			'tindakanPasiens' => array(self::HAS_MANY, 'TindakanPasien', 'pendaftaran_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pegawai_id' => 'Pegawai',
			'pasien_id' => 'Pasien',
			'tanggal' => 'Tanggal',
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
		$criteria->compare('pegawai_id',$this->pegawai_id);
		$criteria->compare('pasien_id',$this->pasien_id);
		$criteria->compare('tanggal',$this->tanggal,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pendaftaran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
