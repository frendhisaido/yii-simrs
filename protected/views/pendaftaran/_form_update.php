<?php
/* @var $this PendaftaranController */
/* @var $model Pendaftaran */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pendaftaran-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id', array('value' => Yii::app()->user->id, 'readonly' => true)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pasien'); ?>
		<?php
		Yii::import('Pasien.models.Pasien');

		echo $form->dropDownList($model,'pasien_id',Pasien::model()->getPasienList());
		?>
		<?php echo $form->error($model,'pasien'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal'); ?>
		<?php echo $form->textField($model,'tanggal', array('value' => date('Y-m-d'), 'readonly' => true)); ?>
		<?php echo $form->error($model,'tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'obatPasiens'); ?>
		<?php
		Yii::import('Obat.models.Obat');
		echo $form->checkBoxList($model, 'obatPasiens', CHtml::listData(Obat::model()->findAll(), 'id', 'nama'));
		?>
		<?php echo $form->error($model, 'obatPasiens'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'tindakanPasiens'); ?>
		<?php
		Yii::import('Tindakan.models.Tindakan');
		echo $form->checkBoxList($model, 'tindakanPasiens', CHtml::listData(Tindakan::model()->findAll(), 'id', 'nama'));
		?>
		<?php echo $form->error($model, 'tindakanPasiens'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
