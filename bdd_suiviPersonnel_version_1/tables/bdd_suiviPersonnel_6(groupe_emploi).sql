CREATE TABLE `pers_groupe_emplois` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `groupe_emploi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_groupe_emplois` (`id`, `groupe_emploi`,`created_at`, `updated_at`) VALUES
(1,'Groupe 1','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Groupe 2','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Groupe 3','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Groupe 4','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Groupe 5','2022-05-17 11:56:28', '2022-05-17 11:56:28');
DROP TABLE IF EXISTS pers_categorie_emplois;
CREATE TABLE `pers_categorie_emplois` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `categorie_emploi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
    `groupe_emploi_id` bigint(20) UNSIGNED NOT NULL  REFERENCES pers_groupe_emplois(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_categorie_emplois` (`id`, `categorie_emploi`,`groupe_emploi_id`,`created_at`, `updated_at`) VALUES
(1,'M1',1,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'M2',1,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'1A',1,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'1B',1,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'OS1',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'OS2',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(7,'OS3',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(8,'OP1',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(9,'2A',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(10,'2B',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(11,'3A',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(12,'3B',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(13,'A1',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(14,'A2',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(15,'A3',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(16,'B1',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(17,'B2',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(18,'B3',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(19,'B4',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(20,'C1',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(21,'C2',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(22,'C3',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(23,'D1',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(24,'D2',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(25,'D3',2,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(26,'OP2',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(27,'OP3',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(28,'4A',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(29,'4B',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(30,'5A',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(31,'5B',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(32,'A4',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(33,'B5',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(34,'C4',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(35,'D4',3,'2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(36,'Hors catégorie',0,'2022-05-17 11:56:28', '2022-05-17 11:56:28');


ALTER TABLE employers ADD COLUMN groupe_emploi_id bigint(20) UNSIGNED DEFAULT NULL REFERENCES pers_groupe_emplois(id) ON DELETE CASCADE;

ALTER TABLE pers_historique_employers ADD COLUMN groupe_emploi_id bigint(20) UNSIGNED DEFAULT NULL REFERENCES pers_groupe_emplois(id) ON DELETE CASCADE;
ALTER TABLE pers_contact_urgences ADD pers_a_charge_id bigint(20) UNSIGNED REFERENCES pers_personne_a_charges(id) ON DELETE CASCADE;
