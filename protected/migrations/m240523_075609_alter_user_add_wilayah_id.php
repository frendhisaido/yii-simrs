<?php

class m240523_075609_alter_user_add_wilayah_id extends CDbMigration
{
	public function up()
	{
		$this->addColumn('users', 'wilayah_id', 'int(11) DEFAULT NULL');
		$this->addForeignKey('fk_user_wilayah', 'users', 'wilayah_id', 'wilayah', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		echo "m240523_075609_alter_user_add_wilayah_id does not support migration down.\n";
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