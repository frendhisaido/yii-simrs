-- Seed 100 Pasiens
INSERT INTO
    `pasien` (`nama`, `alamat`)
SELECT
    CONCAT('Pasien ', seq) AS `nama`,
    CONCAT('Alamat ', seq) AS `alamat`
FROM
    (
        SELECT
            @rownum := @rownum + 1 AS seq
        FROM
            (
                SELECT
                    0
                UNION
                ALL
                SELECT
                    1
                UNION
                ALL
                SELECT
                    2
                UNION
                ALL
                SELECT
                    3
            ) t1,
            (
                SELECT
                    0
                UNION
                ALL
                SELECT
                    1
                UNION
                ALL
                SELECT
                    2
                UNION
                ALL
                SELECT
                    3
            ) t2,
            (
                SELECT
                    0
                UNION
                ALL
                SELECT
                    1
                UNION
                ALL
                SELECT
                    2
                UNION
                ALL
                SELECT
                    3
            ) t3,
            (
                SELECT
                    0
                UNION
                ALL
                SELECT
                    1
                UNION
                ALL
                SELECT
                    2
                UNION
                ALL
                SELECT
                    3
            ) t4,
            (
                SELECT
                    @rownum := 0
            ) t0
    ) seqs
LIMIT
    100;

INSERT INTO
    `pendaftaran` (`pasien_id`, `tanggal`, `user_id`)
SELECT
    p.id AS `pasien_id`,
    DATE_ADD(CURDATE(), INTERVAL FLOOR(RAND() * 7) DAY) AS `tanggal`,
    1 AS `user_id`
FROM
    `pasien` p;

-- Seed Tindakan for each Pendaftaran
INSERT INTO
    `tindakan_pasien` (`pendaftaran_id`, `tindakan_id`)
SELECT
    p.id AS `pendaftaran_id`,
    1 AS `tindakan_id`
FROM
    `pendaftaran` p;

-- Seed Obat for each Pendaftaran
INSERT INTO
    `obat_pasien` (`pendaftaran_id`, `obat_id`)
SELECT
    p.id AS `pendaftaran_id`,
    1 AS `obat_id`
FROM
    `pendaftaran` p;

INSERT INTO
    `obat_pasien` (`pendaftaran_id`, `obat_id`)
SELECT
    p.id AS `pendaftaran_id`,
    2 AS `obat_id`
FROM
    `pendaftaran` p;

-- Seed Tagihan for each Pendaftaran
INSERT INTO
    `tagihan` (
        `pasien_id`,
        `created_by`,
        `pendaftaran_id`,
        `total_tagihan`,
        `rincian_tagihan`
    )
SELECT
    p.pasien_id AS `pasien_id`,
    1 AS `created_by`,
    p.id AS `pendaftaran_id`,
    FLOOR(10000 + (RAND() * 490000)) AS `total_tagihan`,
    'Rincian tagihan' AS `rincian_tagihan`
FROM
    `pendaftaran` p;

-- Seed Tindakan_Tagihan for each Tagihan
INSERT INTO
    `tindakan_tagihan` (`tindakan_id`, `tagihan_id`)
SELECT
    1 AS `tindakan_id`,
    t.id AS `tagihan_id`
FROM
    `tagihan` t;

-- Seed Obat_Tagihan for each Tagihan
INSERT INTO
    `obat_tagihan` (`obat_id`, `tagihan_id`)
SELECT
    1 AS `obat_id`,
    t.id AS `tagihan_id`
FROM
    `tagihan` t;

INSERT INTO
    `obat_tagihan` (`obat_id`, `tagihan_id`)
SELECT
    2 AS `obat_id`,
    t.id AS `tagihan_id`
FROM
    `tagihan` t;