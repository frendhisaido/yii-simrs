<?php

class m240523_124500_alter_pendaftaran_remove_pegawai_add_user extends CDbMigration
{
    public function up()
    {
        // Drop foreign key for pegawai_id
        $this->dropForeignKey('fk_pendaftaran_pegawai', 'pendaftaran');

        // Drop pegawai_id column from pendaftaran table
        $this->dropColumn('pendaftaran', 'pegawai_id');

        // Add user_id column to pendaftaran table
        $this->addColumn('pendaftaran', 'user_id', 'int NOT NULL');

        // Add foreign key for user_id
        $this->addForeignKey('fk_pendaftaran_user', 'pendaftaran', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        // Drop pegawai table
        $this->dropTable('pegawai');
    }

    public function down()
    {
        // Recreate pegawai table
        $this->createTable('pegawai', array(
            'id' => 'pk',
            'nama' => 'string NOT NULL',
            'alamat' => 'string NOT NULL',
            'wilayah_id' => 'int NOT NULL',
        ));

        // Add foreign key for wilayah_id
        $this->addForeignKey('fk_pegawai_wilayah', 'pegawai', 'wilayah_id', 'wilayah', 'id', 'CASCADE', 'CASCADE');

        // Drop foreign key for user_id
        $this->dropForeignKey('fk_pendaftaran_user', 'pendaftaran');

        // Drop user_id column from pendaftaran table
        $this->dropColumn('pendaftaran', 'user_id');

        // Add pegawai_id column to pendaftaran table
        $this->addColumn('pendaftaran', 'pegawai_id', 'int NOT NULL');

        // Add foreign key for pegawai_id
        $this->addForeignKey('fk_pendaftaran_pegawai', 'pendaftaran', 'pegawai_id', 'pegawai', 'id', 'CASCADE', 'CASCADE');
    }
}
