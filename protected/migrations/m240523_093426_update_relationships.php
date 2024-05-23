<?php

class m240523_093426_update_relationships extends CDbMigration
{
    public function up()
    {
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
    }

    public function down()
    {
        $this->dropForeignKey('fk_tindakan_tagihan_tindakan', 'tindakan_tagihan');
        $this->dropForeignKey('fk_tindakan_tagihan_tagihan', 'tindakan_tagihan');
        $this->dropTable('tindakan_tagihan');

        $this->dropForeignKey('fk_obat_tagihan_obat', 'obat_tagihan');
        $this->dropForeignKey('fk_obat_tagihan_tagihan', 'obat_tagihan');
        $this->dropTable('obat_tagihan');
    }
}
