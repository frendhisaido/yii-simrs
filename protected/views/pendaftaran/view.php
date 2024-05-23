<?php
/* @var $this PendaftaranController */
/* @var $model Pendaftaran */

$this->breadcrumbs=array(
	'Pendaftarans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pendaftaran', 'url'=>array('index')),
	array('label'=>'Create Pendaftaran', 'url'=>array('create')),
	array('label'=>'Update Pendaftaran', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pendaftaran', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pendaftaran', 'url'=>array('admin')),
);
?>

<h1>View Pendaftaran #<?php echo $model->id; ?></h1>

<?php 
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		array(
			'name'=>'pasien_id',
			'value'=>$model->pasien->nama
		),
		array(
			'name' => 'Obat',
			'type' => 'raw',
			'value' => CHtml::encode(implode(', ', CHtml::listData($model->obatPasiens, 'obat_id', 'obat.nama'))),
		),
		array(
			'name' => 'Tindakan',
			'type' => 'raw',
			'value' => CHtml::encode(implode(', ', CHtml::listData($model->tindakanPasiens, 'tindakan_id', 'tindakan.nama'))),
		),
		'tanggal',
	),
)); ?>
