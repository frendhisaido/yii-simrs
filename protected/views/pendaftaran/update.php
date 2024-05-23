<?php
/* @var $this PendaftaranController */
/* @var $model Pendaftaran */

$this->breadcrumbs=array(
	'Pendaftarans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pendaftaran', 'url'=>array('index')),
	array('label'=>'Create Pendaftaran', 'url'=>array('create')),
	array('label'=>'View Pendaftaran', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pendaftaran', 'url'=>array('admin')),
);
?>

<h1>Update Pendaftaran <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form_update', array('model'=>$model)); ?>