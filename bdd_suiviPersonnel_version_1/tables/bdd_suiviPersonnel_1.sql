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
(6,'Déplacement du centre'),
(7,'Catégorie d\'emploi modifiée'),
(8,'Ajout pour la première fois'),
(9,'Lieu modifié');


CREATE TABLE `pers_statut_emplois` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `statut_emploi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_statut_emplois` (`id`, `statut_emploi`,`created_at`, `updated_at`) VALUES
(1,'Free-lance','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Contrat à temps plein','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Temps plein permanent','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Probation à temps plein','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Contrat à temps partiel','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Stage à temps partiel','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(7,'Stage à temps plein','2022-05-17 11:56:28', '2022-05-17 11:56:28');



CREATE TABLE `pers_mesure_disciplinaires` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_discipline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_mesure_disciplinaires` (`id`, `nom_discipline`,`created_at`, `updated_at`) VALUES
(1,'Impolitesse','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Propos déplacé','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Abscence','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Présence injustifié','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Vol de temps','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Critique injustifié','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(7,'Vol','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(8,'Vandalisme','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(9,'Utilisation inappropriée des biens de l\'employeur','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(10,'Insubordination','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(11,'Attitude envers les supérieurs','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(12,'Réfus d\'excécuter une tâche','2022-05-17 11:56:28', '2022-05-17 11:56:28');

CREATE TABLE `pers_mesure_administratives` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `descriptions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_mesure_administratives` (`id`, `descriptions`,`created_at`, `updated_at`) VALUES
(1,'Abscence','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Dépendances','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Incompétence','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Incapacité à travailler dans le cadre de l\'entreprise','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Incapacité à fournir la prestation de travail','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Perte de permis de travail','2022-05-17 11:56:28', '2022-05-17 11:56:28');


CREATE TABLE `pers_sanctions` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_saction` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pers_sanctions` (`id`, `nom_saction`,`created_at`, `updated_at`) VALUES
(1,'Avis verbal','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2,'Avis écrit','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(3,'Reprimande','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(4,'Plan de redressement','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(5,'Suspension sans solde de courte durée(1 à 3 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(6,'Suspension sans solde de moyenne durée(5 à 10 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(7,'Suspension sans solde de longue durée(plus de 10 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(8,'Suspension sans solde de très longue durée(plus de 60 jours)','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(9,'Suspension sans solde congédiement','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(10,'Fin d\'emploi','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(11,'l’avertissement','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(12,'le blâme','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(13,'la mise à pied disciplinaire','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(14,'la mise à pied conservatoire','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(15,'la rétrogradation','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(16,'la mutation','2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(17,'le licenciement','2022-05-17 11:56:28', '2022-05-17 11:56:28');
