-- klinik.AuthAssignment definition
CREATE TABLE `AuthAssignment` (
    `itemname` varchar(64) NOT NULL,
    `userid` varchar(64) NOT NULL,
    `bizrule` text,
    `data` text,
    PRIMARY KEY (`itemname`, `userid`)
) ENGINE = MyISAM DEFAULT CHARSET = latin1;

-- klinik.AuthItem definition
CREATE TABLE `AuthItem` (
    `name` varchar(64) NOT NULL,
    `type` int NOT NULL,
    `description` text,
    `bizrule` text,
    `data` text,
    PRIMARY KEY (`name`)
) ENGINE = MyISAM DEFAULT CHARSET = latin1;

-- klinik.AuthItemChild definition
CREATE TABLE `AuthItemChild` (
    `parent` varchar(64) NOT NULL,
    `child` varchar(64) NOT NULL,
    PRIMARY KEY (`parent`, `child`),
    KEY `child` (`child`)
) ENGINE = MyISAM DEFAULT CHARSET = latin1;

-- klinik.obat definition
CREATE TABLE `obat` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nama` varchar(255) NOT NULL,
    `harga` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.pasien definition
CREATE TABLE `pasien` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nama` varchar(255) NOT NULL,
    `alamat` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.profiles_fields definition
CREATE TABLE `profiles_fields` (
    `id` int NOT NULL AUTO_INCREMENT,
    `varname` varchar(50) NOT NULL DEFAULT '',
    `title` varchar(255) NOT NULL DEFAULT '',
    `field_type` varchar(50) NOT NULL DEFAULT '',
    `field_size` int NOT NULL DEFAULT '0',
    `field_size_min` int NOT NULL DEFAULT '0',
    `required` int NOT NULL DEFAULT '0',
    `match` varchar(255) NOT NULL DEFAULT '',
    `range` varchar(255) NOT NULL DEFAULT '',
    `error_message` varchar(255) NOT NULL DEFAULT '',
    `other_validator` text,
    `default` varchar(255) NOT NULL DEFAULT '',
    `widget` varchar(255) NOT NULL DEFAULT '',
    `widgetparams` text,
    `position` int NOT NULL DEFAULT '0',
    `visible` int NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb3;

-- klinik.tbl_migration definition
CREATE TABLE `tbl_migration` (
    `version` varchar(180) NOT NULL,
    `apply_time` int DEFAULT NULL,
    PRIMARY KEY (`version`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.tindakan definition
CREATE TABLE `tindakan` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nama` varchar(255) NOT NULL,
    `harga` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.wilayah definition
CREATE TABLE `wilayah` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nama` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.users definition
CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(20) NOT NULL DEFAULT '',
    `password` varchar(128) NOT NULL DEFAULT '',
    `email` varchar(128) NOT NULL DEFAULT '',
    `activkey` varchar(128) NOT NULL DEFAULT '',
    `superuser` int NOT NULL DEFAULT '0',
    `status` int NOT NULL DEFAULT '0',
    `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `lastvisit_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `wilayah_id` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_username` (`username`),
    UNIQUE KEY `user_email` (`email`),
    KEY `fk_user_wilayah` (`wilayah_id`),
    CONSTRAINT `fk_user_wilayah` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb3;

-- klinik.pendaftaran definition
CREATE TABLE `pendaftaran` (
    `id` int NOT NULL AUTO_INCREMENT,
    `pasien_id` int NOT NULL,
    `tanggal` date NOT NULL,
    `user_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_pendaftaran_pasien` (`pasien_id`),
    KEY `fk_pendaftaran_user` (`user_id`),
    CONSTRAINT `fk_pendaftaran_pasien` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_pendaftaran_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.profiles definition
CREATE TABLE `profiles` (
    `user_id` int NOT NULL AUTO_INCREMENT,
    `first_name` varchar(255) DEFAULT NULL,
    `last_name` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`user_id`),
    CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb3;

-- klinik.tagihan definition
CREATE TABLE `tagihan` (
    `id` int NOT NULL AUTO_INCREMENT,
    `pasien_id` int NOT NULL,
    `created_by` int NOT NULL,
    `pendaftaran_id` int NOT NULL,
    `total_tagihan` decimal(10, 2) NOT NULL,
    `rincian_tagihan` text NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_tagihan_pasien` (`pasien_id`),
    KEY `fk_tagihan_created_by_user` (`created_by`),
    KEY `fk_tagihan_pendaftaran` (`pendaftaran_id`),
    CONSTRAINT `fk_tagihan_created_by_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
    CONSTRAINT `fk_tagihan_pasien` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_tagihan_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.tindakan_pasien definition
CREATE TABLE `tindakan_pasien` (
    `id` int NOT NULL AUTO_INCREMENT,
    `pendaftaran_id` int NOT NULL,
    `tindakan_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_tindakan_pasien_pendaftaran` (`pendaftaran_id`),
    KEY `fk_tindakan_pasien_tindakan` (`tindakan_id`),
    CONSTRAINT `fk_tindakan_pasien_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_tindakan_pasien_tindakan` FOREIGN KEY (`tindakan_id`) REFERENCES `tindakan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.tindakan_tagihan definition
CREATE TABLE `tindakan_tagihan` (
    `id` int NOT NULL AUTO_INCREMENT,
    `tindakan_id` int NOT NULL,
    `tagihan_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_tindakan_tagihan_tindakan` (`tindakan_id`),
    KEY `fk_tindakan_tagihan_tagihan` (`tagihan_id`),
    CONSTRAINT `fk_tindakan_tagihan_tagihan` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_tindakan_tagihan_tindakan` FOREIGN KEY (`tindakan_id`) REFERENCES `tindakan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.obat_pasien definition
CREATE TABLE `obat_pasien` (
    `id` int NOT NULL AUTO_INCREMENT,
    `pendaftaran_id` int NOT NULL,
    `obat_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_obat_pasien_pendaftaran` (`pendaftaran_id`),
    KEY `fk_obat_pasien_obat` (`obat_id`),
    CONSTRAINT `fk_obat_pasien_obat` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_obat_pasien_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.obat_tagihan definition
CREATE TABLE `obat_tagihan` (
    `id` int NOT NULL AUTO_INCREMENT,
    `obat_id` int NOT NULL,
    `tagihan_id` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_obat_tagihan_obat` (`obat_id`),
    KEY `fk_obat_tagihan_tagihan` (`tagihan_id`),
    CONSTRAINT `fk_obat_tagihan_obat` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_obat_tagihan_tagihan` FOREIGN KEY (`tagihan_id`) REFERENCES `tagihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- klinik.pembayaran definition
CREATE TABLE `pembayaran` (
    `id` int NOT NULL AUTO_INCREMENT,
    `pendaftaran_id` int NOT NULL,
    `total` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_pembayaran_pendaftaran` (`pendaftaran_id`),
    CONSTRAINT `fk_pembayaran_pendaftaran` FOREIGN KEY (`pendaftaran_id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;