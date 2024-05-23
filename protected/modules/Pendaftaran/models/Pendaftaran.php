<?php

Yii::import('Obat.models.ObatPasien');
Yii::import('Pendaftaran.models.Pembayaran');
Yii::import('Pendaftaran.models.Tagihan');
Yii::import('Pendaftaran.models.TindakanPasien');
Yii::import('Pasien.models.Pasien');
Yii::import('Obat.models.Obat');
Yii::import('Tindakan.models.Tindakan');

/**
 * This is the model class for table "pendaftaran".
 *
 * The followings are the available columns in table 'pendaftaran':
 * @property integer $id
 * @property integer
 * @property integer $pasien_id
 * @property string $tanggal
 *
 * The followings are the available model relations:
 * @property ObatPasien[] $obatPasiens
 * @property Pembayaran[] $pembayarans
 * @property Pasien $pasien
 * @property Tagihan[] $tagihans
 * @property TindakanPasien[] $tindakanPasiens
 */
class Pendaftaran extends CActiveRecord
{
	/**
	 * @var array to hold selected ObatPasiens
	 */
	public $obatPasiens = array();

	/**
	 * @var array to hold selected TindakanPasiens
	 */
	public $tindakanPasiens = array();

	/**
	 * Load model method to always load relations
	 */
	public function loadModel($id)
	{
		$model = $this->findByPk($id, array('with' => array('obatPasiens', 'pembayarans', 'pasien', 'user', 'tagihans', 'tindakanPasiens.tindakan')));
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Override find method to always load relations
	 */
	public function find($condition = '', $params = array())
	{
		$criteria = $this->getCommandBuilder()->createCriteria($condition, $params);
		$criteria->with = array('obatPasiens.obat', 'pembayarans', 'pasien', 'user', 'tagihans', 'tindakanPasiens.tindakan');
		return parent::find($criteria);
	}

	/**
	 * Override findAll method to always load relations
	 */
	public function findAll($condition = '', $params = array())
	{
		$criteria = $this->getCommandBuilder()->createCriteria($condition, $params);
		$criteria->with = array('obatPasiens.obat', 'pembayarans', 'pasien', 'user', 'tagihans', 'tindakanPasiens.tindakan');
		return parent::findAll($criteria);
	}

	/**
	 * Get pendaftaranList for dropDownList
	 */
	public function getPendaftaranList()
	{
		$models = $this->findAll();
		// show pasien nama and tanggal pendaftaran
		$list = CHtml::listData($models, 'id', function($model) {
			return $model->pasien->nama . ' - ' . $model->tanggal;
		});
		return $list;
	}

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
			array('user_id, pasien_id, tanggal', 'required'),
			array('user_id, pasien_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pasien_id, tanggal, obatPasiens, tindakanPasiens', 'safe', 'on'=>'search'),
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
			'obat' => array(self::HAS_MANY, 'Obat', array('obat_id'=>'id'), 'through'=>'obatPasiens'),
			'tindakan' => array(self::HAS_MANY, 'Tindakan', array('tindakan_id'=>'id'), 'through'=>'tindakanPasiens')
		);
	}
	// /**
	//  * After finding the model, populate the obatPasiens and tindakanPasiens arrays.
	//  */
	// protected function afterFind()
	// {
	// 	parent::afterFind();
	// 	$this->obatPasiens = CHtml::listData($this->obatPasiens, 'id', 'obat_id');
	// 	$this->tindakanPasiens = CHtml::listData($this->tindakanPasiens, 'id', 'tindakan_id');
	// }

	protected function beforeFind()
    {
        parent::beforeFind();
        $this->getDbCriteria()->mergeWith(array(
            'with' => array('obat', 'tindakan'), // Always eager load comments
        ));
		
        return true;
    }
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
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
		$criteria->compare('user.username',$this->user_id,true);
		$criteria->compare('pasien.nama',$this->pasien_id,true);
		$criteria->compare('tanggal', $this->tanggal, true);

		$criteria->with = array('pasien','obatPasiens', 'tindakanPasiens');

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
