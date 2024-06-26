<?php

class m240521_103757_create_all_tables extends CDbMigration
{
	public function up()
	{
		// Table wilayah
		$this->createTable('wilayah', array(
			'id' => 'pk',
			'nama' => 'string NOT NULL',
		));
		// Table pegawai
		$this->createTable('pegawai', array(
			'id' => 'pk',
			'nama' => 'string NOT NULL',
			'alamat' => 'string NOT NULL',
			'wilayah_id' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_pegawai_wilayah', 'pegawai', 'wilayah_id', 'wilayah', 'id', 'CASCADE', 'CASCADE');
		// Table tagihan
		$this->createTable('tagihan', array(
			'id' => 'pk',
			'pasien_id' => 'int NOT NULL',
			'created_by' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_tagihan_pasien', 'tagihan', 'pasien_id', 'pasien', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_tagihan_created_by_user', 'tagihan', 'created_by', 'user', 'id', 'CASCADE', 'RESTRICT');
		$this->createTable('tindakan', array(
			'id' => 'pk',
			'nama' => 'string NOT NULL',
			'harga' => 'int NOT NULL',
		));
		// Table obat
		$this->createTable('obat', array(
			'id' => 'pk',
			'nama' => 'string NOT NULL',
			'harga' => 'int NOT NULL',
		));
		// Table pasien
		$this->createTable('pasien', array(
			'id' => 'pk',
			'nama' => 'string NOT NULL',
			'alamat' => 'string NOT NULL',
		));
		//Table: pendaftaran, tindakan_pasien, obat_pasien, pembayaran
		// Table pendaftaran
		$this->createTable('pendaftaran', array(
			'id' => 'pk',
			'pegawai_id' => 'int NOT NULL',
			'pasien_id' => 'int NOT NULL',
			'tanggal' => 'date NOT NULL',
		));
		$this->addForeignKey('fk_pendaftaran_pegawai', 'pendaftaran', 'pegawai_id', 'pegawai', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_pendaftaran_pasien', 'pendaftaran', 'pasien_id', 'pasien', 'id', 'CASCADE', 'CASCADE');
		// Table tindakan_pasien
		$this->createTable('tindakan_pasien', array(
			'id' => 'pk',
			'pendaftaran_id' => 'int NOT NULL',
			'tindakan_id' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_tindakan_pasien_pendaftaran', 'tindakan_pasien', 'pendaftaran_id', 'pendaftaran', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_tindakan_pasien_tindakan', 'tindakan_pasien', 'tindakan_id', 'tindakan', 'id', 'CASCADE', 'CASCADE');
		// Table obat_pasien
		$this->createTable('obat_pasien', array(
			'id' => 'pk',
			'pendaftaran_id' => 'int NOT NULL',
			'obat_id' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_obat_pasien_pendaftaran', 'obat_pasien', 'pendaftaran_id', 'pendaftaran', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_obat_pasien_obat', 'obat_pasien', 'obat_id', 'obat', 'id', 'CASCADE', 'CASCADE');
		// Table tindakan_tagihan
		$this->createTable('tindakan_tagihan', array(
			'id' => 'pk',
			'tindakan_id' => 'int NOT NULL',
			'tagihan_id' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_tindakan_tagihan_tindakan', 'tindakan_tagihan', 'tindakan_id', 'tindakan', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_tindakan_tagihan_tagihan', 'tindakan_tagihan', 'tagihan_id', 'tagihan', 'id', 'CASCADE', 'CASCADE');

		// Table obat_tagihan
		$this->createTable('obat_tagihan', array(
			'id' => 'pk',
			'obat_id' => 'int NOT NULL',
			'tagihan_id' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_obat_tagihan_obat', 'obat_tagihan', 'obat_id', 'obat', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_obat_tagihan_tagihan', 'obat_tagihan', 'tagihan_id', 'tagihan', 'id', 'CASCADE', 'CASCADE');
		$this->createTable('pembayaran', array(
			'id' => 'pk',
			'pendaftaran_id' => 'int NOT NULL',
			'total' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_pembayaran_pendaftaran', 'pembayaran', 'pendaftaran_id', 'pendaftaran', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		echo "m240521_103757_create_all_tables does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
