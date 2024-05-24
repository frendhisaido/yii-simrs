-- Seeder script to add 100 Pasiens, each with 1 Pendaftaran, each Pendaftaran with 1 Tindakan and 2 Obat, each having 1 Tagihan

-- Insert 100 Pasiens
INSERT INTO `pasien` (`nama`, `alamat`)
VALUES
<?php
for ($i = 1; $i <= 100; $i++) {
    echo "('Pasien $i', 'Alamat $i')";
    if ($i < 100) {
        echo ",\n";
    } else {
        echo ";\n";
    }
}
?>

-- Insert 100 Pendaftarans
INSERT INTO `pendaftaran` (`pasien_id`, `tanggal`, `user_id`)
VALUES
<?php
for ($i = 1; $i <= 100; $i++) {
    echo "($i, CURDATE(), 1)";
    if ($i < 100) {
        echo ",\n";
    } else {
        echo ";\n";
    }
}
?>

-- Insert 100 Tindakans
INSERT INTO `tindakan_pasien` (`pendaftaran_id`, `tindakan_id`)
VALUES
<?php
for ($i = 1; $i <= 100; $i++) {
    echo "($i, 1)";
    if ($i < 100) {
        echo ",\n";
    } else {
        echo ";\n";
    }
}
?>

-- Insert 200 Obats (2 per Pendaftaran)
INSERT INTO `obat_pasien` (`pendaftaran_id`, `obat_id`)
VALUES
<?php
for ($i = 1; $i <= 100; $i++) {
    echo "($i, 1),\n";
    echo "($i, 2)";
    if ($i < 100) {
        echo ",\n";
    } else {
        echo ";\n";
    }
}
?>

-- Insert 100 Tagihans
INSERT INTO `tagihan` (`pasien_id`, `created_by`, `pendaftaran_id`, `total_tagihan`, `rincian_tagihan`)
VALUES
<?php
for ($i = 1; $i <= 100; $i++) {
    echo "($i, 1, $i, 1000.00, 'Rincian $i')";
    if ($i < 100) {
        echo ",\n";
    } else {
        echo ";\n";
    }
}
?>

-- Link Tindakan to Tagihan
INSERT INTO `tindakan_tagihan` (`tindakan_id`, `tagihan_id`)
VALUES
<?php
for ($i = 1; $i <= 100; $i++) {
    echo "(1, $i)";
    if ($i < 100) {
        echo ",\n";
    } else {
        echo ";\n";
    }
}
?>

-- Link Obat to Tagihan
INSERT INTO `obat_tagihan` (`obat_id`, `tagihan_id`)
VALUES
<?php
for ($i = 1; $i <= 100; $i++) {
    echo "(1, $i),\n";
    echo "(2, $i)";
    if ($i < 100) {
        echo ",\n";
    } else {
        echo ";\n";
    }
}
?>
