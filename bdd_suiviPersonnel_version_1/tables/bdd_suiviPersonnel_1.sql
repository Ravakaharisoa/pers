CREATE TABLE devise
(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    devise varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE devise add column description  VARCHAR(200);
insert into devise values
(1,"Ar","Ariary");

CREATE TABLE pers_historique_salaires(
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `employer_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
    `ancien_montant` DECIMAL(19,2),
  `nouveau_montant` DECIMAL(19,2),
  `description` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devise_id` bigint(20) UNSIGNED NOT NULL REFERENCES devise(id) ON DELETE CASCADE,
  `evenement_id` bigint(20) UNSIGNED NOT NULL REFERENCES pers_evenements(id) ON DELETE CASCADE,
  `date_modification` DATE NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE pers_historique_fonctions (
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `employer_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `fonction_id` bigint(20) UNSIGNED NOT NULL REFERENCES fonctions(id) ON DELETE CASCADE,
  `statut_emploi_id` bigint(20) UNSIGNED NOT NULL REFERENCES pers_statut_emplois(id) ON DELETE CASCADE,
  `categorie_emploi_id` bigint(20) UNSIGNED NOT NULL REFERENCES pers_categorie_emplois(id) ON DELETE CASCADE,
  `evenement_id` bigint(20) UNSIGNED NOT NULL REFERENCES pers_evenements(id) ON DELETE CASCADE,
  `date_changement` timestamp NULL DEFAULT  current_timestamp(),
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_evenements`( `id`, `description`) VALUES
(1,'Changement du poste'),
(2,'Augmentation de salaire'),
(3,'Contrat initial'),
(4,'Renouvelement de contrat'),
(5,'Promu'),
(6,'D??placement du centre'),
(7,'Cat??gorie d\'emploi modifi??e'),
(8,'Ajout pour la premi??re fois'),
(9,'Lieu modifi??');


CREATE TABLE `pers_statut_emplois` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `statut_emploi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_statut_emplois` (`id`, `statut_emploi`,`created_at`, `updated_at`) VALUES
(1,'Free-lance','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Contrat ?? temps plein','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Temps plein permanent','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Probation ?? temps plein','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Contrat ?? temps partiel','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Stage ?? temps partiel','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(7,'Stage ?? temps plein','2022-05-17 11:56:28', '2022-05-17 11:56:28');



CREATE TABLE `pers_mesure_disciplinaires` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_discipline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_mesure_disciplinaires` (`id`, `nom_discipline`,`created_at`, `updated_at`) VALUES
(1,'Impolitesse','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Propos d??plac??','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Abscence','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Pr??sence injustifi??','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Vol de temps','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Critique injustifi??','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(7,'Vol','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(8,'Vandalisme','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(9,'Utilisation inappropri??e des biens de l\'employeur','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(10,'Insubordination','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(11,'Attitude envers les sup??rieurs','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(12,'R??fus d\'exc??cuter une t??che','2022-05-17 11:56:28', '2022-05-17 11:56:28');

CREATE TABLE `pers_mesure_administratives` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `descriptions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_mesure_administratives` (`id`, `descriptions`,`created_at`, `updated_at`) VALUES
(1,'Abscence','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'D??pendances','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Incomp??tence','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Incapacit?? ?? travailler dans le cadre de l\'entreprise','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Incapacit?? ?? fournir la prestation de travail','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Perte de permis de travail','2022-05-17 11:56:28', '2022-05-17 11:56:28');


CREATE TABLE `pers_sanctions` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_saction` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_sanctions` (`id`, `nom_saction`,`created_at`, `updated_at`) VALUES
(1,'Avis verbal','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Avis ??crit','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Reprimande','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Plan de redressement','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Suspension sans solde de courte dur??e(1 ?? 3 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Suspension sans solde de moyenne dur??e(5 ?? 10 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(7,'Suspension sans solde de longue dur??e(plus de 10 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(8,'Suspension sans solde de tr??s longue dur??e(plus de 60 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(9,'Suspension sans solde cong??diement','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(10,'Fin d\'emploi','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(11,'l???avertissement','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(12,'le bl??me','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(13,'la mise ?? pied disciplinaire','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(14,'la mise ?? pied conservatoire','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(15,'la r??trogradation','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(16,'la mutation','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(17,'le licenciement','2022-05-17 11:56:28', '2022-05-17 11:56:28');
