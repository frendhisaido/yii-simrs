<?php

class m230000_000000_add_total_tagihan_to_tagihan extends CDbMigration
{
    public function up()
    {
        $this->addColumn('tagihan', 'total_tagihan', 'decimal(10,2) NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('tagihan', 'total_tagihan');
    }
}
