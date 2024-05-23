<?php
/* @var $this TagihanController */
/* @var $model Tagihan */

$this->breadcrumbs=array(
	'Tagihans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tagihan', 'url'=>array('index')),
	array('label'=>'Create Tagihan', 'url'=>array('create')),
	array('label'=>'Update Tagihan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tagihan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tagihan', 'url'=>array('admin')),
);
?>

<h1>Tagihan pasien: <?php echo $model->pasien->nama; ?>
(#<?php echo $model->id; ?>)
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'pasien_id',
		'created_by',
		'pendaftaran_id',
		'total_tagihan',
	),
)); ?>
<h3>Rincian Tagihan:</h3>
<?php echo $model->rincian_tagihan; ?>