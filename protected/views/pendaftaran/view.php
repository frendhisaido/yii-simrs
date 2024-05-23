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

<h1>View Pendaftaran #<?php echo $model->id; ?> | 
<?php echo $model->pasien->nama; ?></h1>



<?php
// Display Pendaftaran details
echo CHtml::encode($model->tanggal);

// list all $model->obat
?>

<h3>Obat:</h3>
<ul>
    <?php foreach ($model->obat as $obatPasien): ?>
        <li><?php echo CHtml::encode($obatPasien->nama); // Change `name` to whatever attribute you want to show ?>
		| <?php echo CHtml::encode($obatPasien->harga); ?>
		</li>
    <?php endforeach; ?>
</ul>

<h3>Tindakan:</h3>
<ul>
    <?php foreach ($model->tindakan as $tindakanPasien): ?>
        <li><?php echo CHtml::encode($tindakanPasien->nama); // Change `name` to whatever attribute you want to show ?>
		| <?php echo CHtml::encode($tindakanPasien->harga); ?>
		</li>
    <?php endforeach; ?>
</ul>