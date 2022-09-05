INSERT INTO `pers_demissions` (`id`, `nom_fichier`, `contrat_id`, `employer_id`, `date_demission`, `created_at`, `updated_at`) VALUES
(1, 'demission-102456-24-08-2022.png', 2, 1, '2022-08-17', '2022-08-24 05:16:36', '2022-08-24 05:16:36');

INSERT INTO `pers_contrats` (`id`, `type_contrat_id`, `employer_id`, `date_embauche`, `date_fin`, `date_permanence`, `description`, `nom_fichier`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2022-08-10', '2023-08-10', '2023-08-11', 'contrat initial', 'contrat-102456-10-08-2022.pdf', '2022-08-10 07:00:46', '2022-08-10 07:00:46'),
(2, 2, 1, '2022-08-16', '2023-08-16', '2023-08-17', 'contrat initial', 'contrat-102456-10-08-2022.png', '2022-08-10 07:26:48', '2022-08-10 07:26:48'),
(3, 2, 2, '2022-08-20', '2022-08-30', '2022-09-01', 'contrat initial', 'contrat-102546-19-08-2022.pdf', '2022-08-19 04:46:30', '2022-08-19 04:46:30');

INSERT INTO `employers` (`id`, `matricule_emp`, `nom_emp`, `prenom_emp`, `date_naissance_emp`, `cin_emp`, `email_emp`, `telephone_emp`, `service_id`, `branche_id`, `genre_id`, `departement_entreprises_id`, `adresse_quartier`, `adresse_code_postal`, `adresse_lot`, `adresse_ville`, `adresse_region`, `user_id`, `photos`, `entreprise_id`, `niveau_etude_id`, `activiter`, `prioriter`, `url_photo`, `created_at`, `updated_at`, `nationalite_id`, `status_matri_id`, `fonction_id`, `num_permis`, `passport`, `categorie_emploi_id`, `date_mariage`, `statut_emploi_id`, `num_cnaps`, `num_ostie`, `groupe_emploi_id`) VALUES
(1, '102456', 'RASOARIMALALA', 'Jeanine', '2022-06-30', '10245879630', 'rasoarimalala@gmail.com', '0325864971', 1, 1, 1, 1, 'Analamahitsy', '102', 'II A Z 102', 'Antananarivo', 'Analamanga', 2, NULL, 1, 1, 1, 1, '', '2022-06-30 11:35:42', '2022-08-09 08:36:34', 107, 2, 495, '', NULL, 7, NULL, 3, '', '', 2),
(2, '102546', 'RAHARIMALALA', 'Lanja', '2022-06-30', '10245836598', 'raharimalala@gmail.com', '0321654987', 2, NULL, 1, 2, 'Ivandry', '101', 'II A y 102', 'Antananarivo', 'Analamanga', 4, NULL, 1, 5, 1, 0, NULL, '2022-06-30 12:11:11', '2022-06-30 12:11:11', 107, 2, 506, '', NULL, 0, NULL, 3, '', '', NULL),
(3, '203568', 'RAHARINIRIANA', 'Fenomalala', '2022-06-30', '102487965332', 'rahariniriana@gmail.com', '0215469832', 3, NULL, 1, 2, 'Mahazo', '101', 'II A T 105', 'Antananarivo', 'Analamanga', 5, NULL, 1, 7, 1, 0, NULL, '2022-06-30 12:13:13', '2022-06-30 12:13:13', 107, 1, 507, '', NULL, 0, NULL, 3, '', '', NULL),
(4, '458935', 'RAHAJANIRIANA', 'Njaka Mahery', '2022-06-30', '1023564852014', 'rahajaniriana@gmail.com', '0321548606', 3, NULL, 1, 2, 'Analamahitsy', '101', 'II A Z 102', 'Antananarivo', 'Analamanga', 6, NULL, 1, 1, 1, 0, NULL, '2022-06-30 12:24:13', '2022-06-30 12:24:13', 107, 2, 508, '', NULL, 0, NULL, 3, '', '', NULL),
(6, '', 'cfp', 'cfp', '2022-07-14', '301254789526', 'cfp@gmail.com', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '', NULL, 8, NULL, 2, 1, 1, 1, NULL, '2022-07-14 08:29:48', '2022-07-14 08:29:48', 107, 0, 0, '', NULL, 0, NULL, 3, '', '', NULL);

INSERT INTO `users` (`id`, `name`, `email`, `cin`, `telephone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Levy', 'contact@formation.mg', '301051027178', '0321122233', NULL, '$2y$10$9i0uUmJpIwVtYX1dlEdM5.bNcYXU8CrD8QXDS5loPVAurII6BmbFm', NULL, '2021-08-04 02:53:44', '2021-08-04 02:53:44'),
(2, 'RASOARIMALALA Jeanine', 'rasoarimalala@gmail.com', '10245879630', NULL, NULL, '$2y$10$PHSZUzmXcmrG7quu1afth.DP8.WDLHKe32hgjRYUv6KOPlWVZhQBu', NULL, '2022-06-30 08:35:42', '2022-06-30 08:35:42'),
(3, 'RAVAOMANITRA Célestine', 'ravaomanitra@gmail.com', '012302154563', NULL, NULL, '$2y$10$fcD2xywZlqiaXKkjg2q.xeWnk66jp8ww11oO5LFcuOQDMNPcVSrT6', NULL, '2022-06-30 08:49:51', '2022-06-30 08:49:51'),
(4, 'RAHARIMALALA Lanja', 'raharimalala@gmail.com', '10245836598', '0321654987', NULL, '$2y$10$4f1ZbeX6D2gP5sOiGpSFZuNYXuU83PeD.4bwCgWlX9dxSVy2P82Xe', NULL, '2022-06-30 09:11:11', '2022-06-30 09:11:11'),
(5, 'RAHARINIRIANA Fenomalala', 'rahariniriana@gmail.com', '102487965332', '0215469832', NULL, '$2y$10$fpSi2X85hbCu2QmARNlB5.TtSyt00Cc7yEj8PnH973sPJ05NBFaLu', NULL, '2022-06-30 09:13:13', '2022-06-30 09:13:13'),
(6, 'RAHAJANIRIANA Njaka Mahery', 'rahajaniriana@gmail.com', '1023564852014', '0321548606', NULL, '$2y$10$KrS88NrVPBN3Xn7uZkiZ5.wSKOks0t75svEB/gBJdG7KyRWU8ctNS', NULL, '2022-06-30 09:24:13', '2022-06-30 09:24:13'),
(7, 'cfp cfp', 'cfp@gmail.com', '301254789526', NULL, NULL, '$2y$10$5/2hBSjw5bH/TmcNurx7ruldR1/Y38deVnIRbIL6c8E0h2B6FYAkS', NULL, '2022-07-14 08:29:48', '2022-07-14 08:29:48');


INSERT INTO `role_users` (`id`, `user_id`, `role_id`, `prioriter`, `activiter`) VALUES
(1, 1, 6, 0, 1),
(2, 2, 2, 1, 1),
(3, 2, 3, 0, 0),
(4, 3, 7, 1, 1),
(5, 4, 3, 0, 1),
(6, 5, 3, 0, 1),
(8, 6, 3, 0, 0),
(9, 6, 5, 0, 1),
(10, 7, 3, 0, 1),
(11, 8, 7, 1, 1);

INSERT INTO `pers_historique_salaires` (`id`, `employer_id`, `ancien_montant`, `nouveau_montant`, `description`, `devise_id`, `evenement_id`, `date_modification`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '200000.00', 'salaire de base', 1, 3, '2022-08-09', '2022-08-08 06:56:10', '2022-08-08 06:56:10'),
(2, 1, '200000.00', '250000.00', 'salaire de base', 1, 1, '2022-08-16', '2022-08-08 07:04:54', '2022-08-08 07:04:54'),
(3, 2, NULL, '2500000.00', 'salaire de base', 1, 1, '2022-08-24', '2022-08-19 04:45:37', '2022-08-19 04:45:37');

INSERT INTO `pers_historique_employers` (`ìd`, `employer_id`, `ancien_fonction`, `fonction_id`, `description_poste`, `evenement_id`, `statut_emploi_id`, `categ_emploi_id`, `dept_id`, `branche_id`, `service_id`, `date_changement_fonction`, `groupe_emploi_id`) VALUES
(1, 1, 'Directeurs des services administratifs non classés ailleurs', 515, NULL, 3, 2, 19, 3, 1, 4, '2022-08-05', NULL),
(2, 1, 'Spécialistes, ressources humaines et évolution de carrière', 481, NULL, 6, 1, 1, 3, 1, 2, '2022-08-23', NULL),
(3, 1, 'Barmen', 490, NULL, 1, 2, 36, 3, 1, 4, '2022-08-17', 4),
(4, 1, 'Directeurs des services administratifs non classés ailleurs', 495, NULL, 1, 3, 7, 1, 1, 1, '2022-08-18', 2);


INSERT INTO `departement_entreprises` (`id`, `nom_departement`, `entreprise_id`, `created_at`, `updated_at`) VALUES
(1, 'Informatique', 1, '2022-06-30 11:43:58', '2022-06-30 11:43:58'),
(2, 'Finance et comptabilité', 1, '2022-06-30 12:30:07', '2022-06-30 12:30:07'),
(3, 'Administration', 1, '2022-07-29 12:47:30', '2022-07-29 12:47:30');
INSERT INTO `services` (`id`, `departement_entreprise_id`, `nom_service`, `entreprise_id`) VALUES
(1, 1, 'Dev', 1),
(2, 2, 'Finance', 1),
(3, 2, 'Comptabilité', 1),
(4, 3, 'Ressources Humaines', 1);

INSERT INTO `branches` (`id`, `entreprise_id`, `nom_branche`) VALUES
(1, 1, 'Antananarivo'),
(2, 1, 'Mahajanga');


INSERT INTO `paie_avantage_en_natures` (`id`, `code`, `designation`, `unite`) VALUES
(1, '5000', 'Logement', NULL),
(2, '5001', 'Véhicule', NULL),
(3, '5002', 'Téléphone', NULL);

INSERT INTO `paie_prime_indemnites` (`id`, `code`, `designation`, `unite`) VALUES
(1, '4000', 'Acienneté', NULL),
(2, '4001', 'Treisieme mois', NULL),
(3, '4002', 'Performance', NULL);

INSERT INTO `entreprises` (`id`, `nom_etp`, `adresse_rue`, `adresse_quartier`, `adresse_code_postal`, `adresse_ville`, `adresse_region`, `logo`, `created_at`, `updated_at`, `nif`, `stat`, `rcs`, `cif`, `secteur_id`, `email_etp`, `site_etp`, `activiter`, `telephone_etp`, `url_logo`, `statut_compte_id`, `assujetti_id`, `slogan`, `presentation`, `specialisation`, `type_entreprise_id`) VALUES
(1, 'Numerika', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'Numerika30-06-22.png', '2022-06-30 11:35:42', '2022-06-30 11:35:42', '1203548796', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 11, 'rasoarimalala@gmail.com', 'XXXXXXX', 1, NULL, 'http://localhost:8000/images/entreprises/Numerika30-06-22.png', 1, 1, NULL, NULL, NULL, 1),
(2, 'emedia', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 'emedia14-07-22.png', '2022-07-14 08:29:48', '2022-07-14 08:29:48', '123458967', 'XXXXXXX', 'XXXXXXX', 'XXXXXXX', 5, 'cfp@gmail.com', 'XXXXXXX', 1, NULL, 'http://127.0.0.1:8000/images/CFP/emedia14-07-22.png', 2, 1, NULL, NULL, NULL, 2);

