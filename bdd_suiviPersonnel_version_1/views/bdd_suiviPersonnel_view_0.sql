CREATE OR REPLACE view stagiaires as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_stagiaire,
    (employers.prenom_emp) prenom_stagiaire,
    employers.genre_id,
    (genre.genre) genre_stagiaire,
    (employers.email_emp) mail_stagiaire,
    (employers.telephone_emp) telephone_stagiaire,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.service_id,
    vd.nom_service,
    employers.branche_id,
    url_photo,
    employers.departement_entreprises_id,
     vd.nom_departement,
    employers.photos,
    (fonctions.id) fonction_id,
    (fonctions.nom_fonction) fonction_stagiaire,
    (employers.cin_emp) cin,
    (employers.date_naissance_emp) date_naissance,
    employers.activiter,
    (employers.adresse_quartier) quartier,
    (employers.adresse_code_postal) code_postal,
    (employers.adresse_ville) ville,
    (employers.adresse_region) region,
    (employers.adresse_lot) lot,
    bc.nom_branche,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
LEFT JOIN fonctions ON fonctions.id = employers.fonction_id
JOIN role_users ON role_users.user_id =  employers.user_id
JOIN genre ON genre.id = employers.genre_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
WHERE role_users.role_id=3;


CREATE OR REPLACE view v_employe as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_stagiaire,
    (employers.prenom_emp) prenom_stagiaire,
    employers.genre_id,
    (genre.genre) genre_stagiaire,
    (fonctions.id) fonction_id,
    (fonctions.nom_fonction) fonction_stagiaire,
    (employers.email_emp) mail_stagiaire,
    employers.num_permis,
    employers.num_ostie,
    employers.num_cnaps,
    (employers.telephone_emp) telephone_stagiaire,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    (nationalites.id) nationalite_id,
    (nationalites.nationalite) nationalite_stagiaire,
    (nationalites.pays) pays_stagiaire,
    (status_matri.id) status_matri_id,
    (status_matri.status) status_matri_stagiaire,
    (categ_emploi.id) categorie_emploi_id,
    (categ_emploi.categorie_emploi) categorie_emploi_stagiaire,
    (statut_emploi.id) statut_emploi_id,
    (statut_emploi.statut_emploi) statut_emploi_stagiaire,
    employers.service_id,
    services.nom_service,
    employers.branche_id,
    url_photo,
    employers.departement_entreprises_id,
    dpt_etp.nom_departement,
    employers.photos,
    employers.groupe_emploi_id,
    groupe.groupe_emploi,
    (employers.cin_emp) cin,
    (employers.date_naissance_emp) date_naissance,
    employers.activiter,
    (employers.adresse_quartier) quartier,
    (employers.adresse_code_postal) code_postal,
    (employers.adresse_ville) ville,
    (employers.adresse_region) region,
    (employers.adresse_lot) lot,
    bc.nom_branche,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM employers
LEFT JOIN services ON services.id = employers.service_id
LEFT JOIN departement_entreprises dpt_etp ON dpt_etp.id = employers.departement_entreprises_id
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
LEFT JOIN pers_groupe_emplois groupe ON groupe.id = employers.groupe_emploi_id
LEFT JOIN genre ON genre.id = employers.genre_id
LEFT JOIN fonctions ON fonctions.id = employers.fonction_id
LEFT JOIN pers_status_matrimoniales status_matri ON status_matri.id = employers.status_matri_id
LEFT JOIN pers_categorie_emplois categ_emploi ON categ_emploi.id = employers.categorie_emploi_id
LEFT JOIN pers_statut_emplois statut_emploi ON statut_emploi.id = employers.statut_emploi_id
LEFT JOIN nationalites ON nationalites.id = employers.nationalite_id
LEFT JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id;

CREATE OR REPLACE view v_historique_salaire AS
    SELECT
histo_salaire.id,
histo_salaire.employer_id,
histo_salaire.ancien_montant,
histo_salaire.nouveau_montant,
histo_salaire.date_modification,
histo_salaire.devise_id,
histo_salaire.description,
histo_salaire.evenement_id,
histo_salaire.created_at,
(devise.devise) devise,
(devise.description)reference,
(evenement.description) evenement,
(
    ROUND(((histo_salaire.nouveau_montant - histo_salaire.ancien_montant)*100 / histo_salaire.ancien_montant),2)
) valeur_pourcent
FROM pers_historique_salaires histo_salaire
JOIN devise ON devise.id = histo_salaire.devise_id
JOIN pers_evenements evenement ON evenement.id = histo_salaire.evenement_id;
