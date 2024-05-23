<?php

class m240523_123456_add_tagihan_pendaftaran_relation extends CDbMigration
{
    public function up()
    {
        // Add pendaftaran_id column to tagihan table
        $this->addColumn('tagihan', 'pendaftaran_id', 'int NOT NULL');

        // Add foreign key for pendaftaran_id
        $this->addForeignKey('fk_tagihan_pendaftaran', 'tagihan', 'pendaftaran_id', 'pendaftaran', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key for pendaftaran_id
        $this->dropForeignKey('fk_tagihan_pendaftaran', 'tagihan');

        // Drop pendaftaran_id column from tagihan table
        $this->dropColumn('tagihan', 'pendaftaran_id');
    }
}
