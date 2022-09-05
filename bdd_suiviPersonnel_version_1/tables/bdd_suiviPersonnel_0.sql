DELETE FROM secteurs;
INSERT INTO `secteurs` (`id`,`nom_secteur`) VALUES
(1, 'Agriculture, nature, animaux, environnement'),
(2, 'Agro-alimentaire'),
(3, 'Automobile, mécanique, techniciens, ingénieurs'),
(4, 'Commerce'),
(5, 'Construction, second œuvre'),
(6, 'Droit, administration, gouvernement'),
(7, 'Education, recherche, formation'),
(8, 'Emplois administratifs, secrétaires, postes et téléphone'),
(9, 'Encadrement, direction'),
(10, 'Finance, banque, assurance'),
(11, 'Hôtellerie, tourisme, loisirs et sports'),
(12, 'Informatique, télécommunication'),
(13, 'Langues, bibliothèques, archivage, conservation'),
(14, 'Mercatique, relations publiques, publicité'),
(15, 'Média, graphisme, imprimerie, art et création'),
(16, 'Métallurgie, mécanique, production industrielle'),
(17, 'Nettoyage et assainissement'),
(18, 'Pétrole, gaz, mines, production d\'énergie, services publics'),
(19, 'Ressources humaines, relations professionnelles, organisation'),
(20, 'Santé, paramédical, laboratoires'),
(21, 'Sécurité, armée, police'),
(22, 'Transports et logistique'),
(23, 'Travail social, soin à la personne, enfance');

CREATE TABLE `pers_evenements`
(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `description` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `pers_status_matrimoniales`
(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `status` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO `pers_status_matrimoniales` (`id`, `status`) VALUES
(1, 'Célibataire'),
(2, 'Marié(e)'),
(3, 'Divorcé(e)'),
(4,'Veuf(ve)');

CREATE TABLE `pers_groupe_sanguins`
(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `groupe_sang` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `pers_allergies`
(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom_allergie` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `pers_maladie_chroniques`
(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom_maladie` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `pers_intolerances`
(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom_intolérance` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `pers_information_sanitaires` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `employer_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `groupe_sanguin_id`  bigint(20) UNSIGNED NOT NULL REFERENCES pers_groupe_sanguins(id) ON DELETE CASCADE,
  `allergie_id`  bigint(20) UNSIGNED NOT NULL REFERENCES pers_allergies(id) ON DELETE CASCADE,
  `intolerance_id`  bigint(20) UNSIGNED NOT NULL REFERENCES pers_intolerances(id) ON DELETE CASCADE,
  `maladie_id` bigint(20) UNSIGNED NOT NULL REFERENCES maladie_chroniques(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

ALTER TABLE employers DROP COLUMN fonction_emp;
ALTER TABLE employers ADD date_mariage DATE;
ALTER TABLE employers ADD nationalite_id bigint(20) UNSIGNED DEFAULT NULL REFERENCES nationalites(id) ON DELETE CASCADE;
ALTER TABLE employers ADD status_matri_id bigint(20) UNSIGNED DEFAULT NULL REFERENCES pers_status_matrimoniales(id) ON DELETE CASCADE;
ALTER TABLE employers ADD fonction_id bigint(20) UNSIGNED DEFAULT NULL REFERENCES fonctions(id) ON DELETE CASCADE;
ALTER TABLE employers ADD statut_emploi_id bigint(20) UNSIGNED DEFAULT NULL REFERENCES pers_statut_emplois(id) ON DELETE CASCADE;
ALTER TABLE employers ADD categorie_emploi_id bigint(20) UNSIGNED DEFAULT NULL REFERENCES pers_categorie_emplois(id) ON DELETE CASCADE;

ALTER TABLE employers ADD num_cnaps VARCHAR(191) DEFAULT NULL;

ALTER TABLE employers ADD num_ostie VARCHAR(191) DEFAULT NULL;

ALTER TABLE employers ADD num_permis VARCHAR(191) DEFAULT NULL;

ALTER TABLE employers ADD passport VARCHAR(191) DEFAULT NULL;