<?php

class m240523_093425_create_tagihan_table extends CDbMigration
{
	public function up()
	{

		$this->createTable('tagihan', array(
			'id' => 'pk',
			'pasien_id' => 'int NOT NULL',
			'created_by' => 'int NOT NULL',
		));
		$this->addForeignKey('fk_tagihan_pasien', 'tagihan', 'pasien_id', 'pasien', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_tagihan_created_by_user', 'tagihan', 'created_by', 'users', 'id', 'CASCADE', 'RESTRICT');
	}

	public function down()
	{
		$this->dropForeignKey('fk_tagihan_pasien', 'tagihan');
		$this->dropForeignKey('fk_tagihan_created_by_user', 'tagihan');
		$this->dropTable('tagihan');
	}

}
