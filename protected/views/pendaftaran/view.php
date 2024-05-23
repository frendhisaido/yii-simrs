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
// Display Pendaftaran details
echo CHtml::encode($model->tanggal);

// Manually load all obatPasiens and tindakanPasiens
$model->obatPasiens = $model->obatPasiens;
$model->tindakanPasiens = $model->tindakanPasiens;

if (!empty($model->obatPasiens)) {
    echo "<h3>Obat Pasiens</h3>";
    foreach ($model->obatPasiens as $obatPasien) {
        echo CHtml::encode($obatPasien->obat->nama) . " - " . CHtml::encode($obatPasien->obat->harga);
    }
} else {
    echo "<p>No obat pasien found.</p>";
}

// Display related TindakanPasiens
if (!empty($model->tindakanPasiens)) {
    echo "<h3>Tindakan Pasiens</h3>";
    foreach ($model->tindakanPasiens as $tindakanPasien) {
        echo CHtml::encode($tindakanPasien->tindakan->nama) . " - " . CHtml::encode($tindakanPasien->tindakan->harga);
    }
} else {
    echo "<p>No tindakan pasien found.</p>";
}
?>
