<?php
/* @var $this PendaftaranController */
/* @var $data Pendaftaran */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pasien_id')); ?>:</b>
	<?php echo CHtml::encode($data->pasien->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tanggal),array('view', 'id'=>$data->id)); ?>
	<br />


</div>