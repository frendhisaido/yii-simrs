<?php

class m240523_093425_create_pasien_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('pasien', array(
			'id' => 'pk',
			'nama' => 'string NOT NULL',
			'usia' => 'integer NOT NULL',
			'jenis_kelamin' => 'string NOT NULL',
			'wilayah_id' => 'integer NOT NULL',
		));

		$this->addForeignKey('fk_pasien_wilayah', 'pasien', 'wilayah_id', 'wilayah', 'id', 'CASCADE', 'RESTRICT');

		$this->createTable('pasien_tindakan', array(
			'pasien_id' => 'integer NOT NULL',
			'tindakan_id' => 'integer NOT NULL',
			'PRIMARY KEY(pasien_id, tindakan_id)',
		));

		$this->addForeignKey('fk_pasien_tindakan_pasien', 'pasien_tindakan', 'pasien_id', 'pasien', 'id', 'CASCADE', 'RESTRICT');
		$this->addForeignKey('fk_pasien_tindakan_tindakan', 'pasien_tindakan', 'tindakan_id', 'tindakan', 'id', 'CASCADE', 'RESTRICT');

		$this->createTable('pasien_obat', array(
			'pasien_id' => 'integer NOT NULL',
			'obat_id' => 'integer NOT NULL',
			'PRIMARY KEY(pasien_id, obat_id)',
		));

		$this->addForeignKey('fk_pasien_obat_pasien', 'pasien_obat', 'pasien_id', 'pasien', 'id', 'CASCADE', 'RESTRICT');
		$this->addForeignKey('fk_pasien_obat_obat', 'pasien_obat', 'obat_id', 'obat', 'id', 'CASCADE', 'RESTRICT');

		$this->createTable('pasien_tagihan', array(
			'pasien_id' => 'integer NOT NULL',
			'tagihan_id' => 'integer NOT NULL',
			'PRIMARY KEY(pasien_id, tagihan_id)',
		));

		$this->addForeignKey('fk_pasien_tagihan_pasien', 'pasien_tagihan', 'pasien_id', 'pasien', 'id', 'CASCADE', 'RESTRICT');
		$this->addForeignKey('fk_pasien_tagihan_tagihan', 'pasien_tagihan', 'tagihan_id', 'tagihan', 'id', 'CASCADE', 'RESTRICT');
	}

	public function down()
	{
		$this->dropForeignKey('fk_pasien_wilayah', 'pasien');
		$this->dropTable('pasien');

		$this->dropForeignKey('fk_pasien_tindakan_pasien', 'pasien_tindakan');
		$this->dropForeignKey('fk_pasien_tindakan_tindakan', 'pasien_tindakan');
		$this->dropTable('pasien_tindakan');

		$this->dropForeignKey('fk_pasien_obat_pasien', 'pasien_obat');
		$this->dropForeignKey('fk_pasien_obat_obat', 'pasien_obat');
		$this->dropTable('pasien_obat');

		$this->dropForeignKey('fk_pasien_tagihan_pasien', 'pasien_tagihan');
		$this->dropForeignKey('fk_pasien_tagihan_tagihan', 'pasien_tagihan');
		$this->dropTable('pasien_tagihan');
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
