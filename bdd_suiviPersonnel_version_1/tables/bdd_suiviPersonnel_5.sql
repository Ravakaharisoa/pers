CREATE TABLE `pers_demissions` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_fichier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
`contrat_id` bigint(20) UNSIGNED NOT NULL  REFERENCES pers_contrats(id) ON DELETE CASCADE,
`employer_id` bigint(20) UNSIGNED NOT NULL  REFERENCES employers(id) ON DELETE CASCADE,
`date_demission` DATE NULL DEFAULT  current_timestamp(),
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE  IF EXISTS pers_avantage_en_nature;
CREATE TABLE pers_avantage_en_nature(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `employer_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `avantage_nature_id` bigint(20) UNSIGNED NOT NULL REFERENCES paie_avantage_en_natures(id) ON DELETE CASCADE,
  `montant` decimal(19,2),
  `devise_id` bigint(20) UNSIGNED NOT NULL REFERENCES devise(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE pers_prime_indemnites(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `employer_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `prime_indemnite_id` bigint(20) UNSIGNED NOT NULL REFERENCES paie_prime_indemnites(id) ON DELETE CASCADE,
  `montant` decimal(19,2),
  `devise_id` bigint(20) UNSIGNED NOT NULL REFERENCES devise(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE pers_demissions ADD entreprise_id bigint(20) UNSIGNED NULL REFERENCES entreprises(id) ON DELETE CASCADE;

ALTER TABLE pers_contrats ADD entreprise_id bigint(20) UNSIGNED NULL REFERENCES entreprises(id) ON DELETE CASCADE;

ALTER TABLE `pers_contrats` CHANGE `entreprise_id` `entreprise_id` BIGINT(20) UNSIGNED NULL;
ALTER TABLE `pers_contrats` ADD FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `pers_contrats` CHANGE `entreprise_id` `entreprise_id` BIGINT(20) UNSIGNED NOT NULL;
ALTER TABLE `pers_documents` ADD `entreprise_id` BIGINT(20) UNSIGNED NOT NULL AFTER `employer_id`;
ALTER TABLE `pers_documents` ADD FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `pers_documents` ADD FOREIGN KEY (`employer_id`) REFERENCES `employers`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
