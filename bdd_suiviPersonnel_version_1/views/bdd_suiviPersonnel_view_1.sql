
CREATE OR REPLACE VIEW v_departement_service_entreprise AS SELECT
     dep.id as departement_entreprise_id,
    serv.id as service_id,
    etp.id as entreprise_id,
    etp.nom_etp,
    dep.nom_departement,
    serv.nom_service
FROM
    departement_entreprises dep,
    entreprises etp,
    services serv
WHERE
    dep.entreprise_id = etp.id AND
    serv.departement_entreprise_id = dep.id;


CREATE OR REPLACE view responsables as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_resp,
    (employers.prenom_emp) prenom_resp,
    employers.genre_id,
    (genre.genre) sexe_resp,
    employers.fonction_id,
    (fonctions.nom_fonction) fonction_resp,
    (employers.email_emp) email_resp,
    (employers.telephone_emp) telephone_resp,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.service_id,
    vd.nom_service,
    url_photo,
    employers.departement_entreprises_id,
    vd.nom_departement,
    employers.photos,
    (employers.cin_emp) cin_resp,
    (employers.date_naissance_emp) date_naissance_resp,
    employers.activiter,
    employers.adresse_quartier,
    employers.adresse_code_postal,
    employers.adresse_ville,
    employers.adresse_region,
    employers.adresse_lot,
    employers.branche_id,
    bc.nom_branche,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM
employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
JOIN role_users ON role_users.user_id =  employers.user_id
LEFT JOIN fonctions ON fonctions.id = employers.fonction_id
JOIN genre ON genre.id = employers.genre_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
WHERE role_users.role_id=2;


CREATE OR REPLACE view chef_departements as
SELECT
    employers.id,
    employers.entreprise_id,
    e.nom_etp,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_chef,
    (employers.prenom_emp) prenom_chef,
    employers.genre_id,
    (genre.genre) genre_chef,
    employers.fonction_id,
    (fonctions.nom_fonction) fonction_chef,
    (employers.email_emp) mail_chef,
    (employers.telephone_emp) telephone_chef,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.branche_id,
    bc.nom_branche,
    employers.service_id,
    vd.nom_service,
    url_photo,
    employers.departement_entreprises_id,
    vd.nom_departement,
    employers.photos,
    (employers.cin_emp) cin_chef,
    (employers.date_naissance_emp) date_naissance_chef,
    employers.activiter,
    employers.adresse_quartier,
    employers.adresse_code_postal,
    employers.adresse_ville,
    employers.adresse_region,
    employers.adresse_lot,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM
employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
JOIN role_users ON role_users.user_id =  employers.user_id
JOIN genre ON genre.id = employers.genre_id
LEFT JOIN fonctions ON fonctions.id= employers.fonction_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
JOIN entreprises e ON e.id = employers.entreprise_id
WHERE role_users.role_id=5;

create or replace view  v_responsable_entreprise as
    select r.id as responsable_id,
        r.nom_resp,
        r.prenom_resp,
        r.fonction_resp,
        r.email_resp,
        r.cin_resp,
        r.telephone_resp,
        r.user_id as user_id_responsable,
        r.photos,
        r.entreprise_id as entreprise_id_responsable,
        r.activiter as activiter_responsable,
        r.user_id,
        r.prioriter,
        e.id as entreprise_id,
        e.nom_etp,
        e.adresse_rue as adresse_lot,
        e.adresse_quartier,
        e.adresse_code_postal,
        e.adresse_ville,
        e.adresse_region,
        e.logo as logo_entreprise,
        e.nif as nif_etp,
        e.stat as stat_etp,
        e.rcs as rcs_etp,
        e.cif as cif_etp,
        e.secteur_id as secteur_id_etp,
        e.email_etp,
        e.site_etp,
        e.activiter as activiter_etp,
        e.telephone_etp
        from responsables r
        join
            entreprises e on e.id = r.entreprise_id;


CREATE OR REPLACE view v_historique_emploi as
SELECT
    (histo_emploi.ìd) histo_emploi_id,
    employers.entreprise_id,
    histo_emploi.employer_id,
    histo_emploi.fonction_id,
    histo_emploi.ancien_fonction,
    (fonctions.nom_fonction) new_fonct,
    histo_emploi.evenement_id,
    histo_emploi.description_poste,
    (pers_evenements.description)evenement,
    histo_emploi.date_changement_fonction,
    histo_emploi.statut_emploi_id,
    pers_statut_emplois.statut_emploi,
    histo_emploi.categ_emploi_id,
    pers_categorie_emplois.categorie_emploi,
    histo_emploi.dept_id,
	histo_emploi.groupe_emploi_id,
    groupe.groupe_emploi,
    departement_entreprises.nom_departement,
    histo_emploi.branche_id,
    branches.nom_branche,
    histo_emploi.service_id,
    services.nom_service

FROM `pers_historique_employers` histo_emploi
JOIN employers ON employers.id= histo_emploi.employer_id
LEFT JOIN fonctions ON fonctions.id = histo_emploi.fonction_id
LEFT JOIN pers_evenements ON pers_evenements.id = histo_emploi.evenement_id
LEFT JOIN pers_statut_emplois ON pers_statut_emplois.id = histo_emploi.statut_emploi_id
LEFT JOIN pers_categorie_emplois ON pers_categorie_emplois.id = histo_emploi.categ_emploi_id
LEFT JOIN departement_entreprises ON departement_entreprises.id = histo_emploi.dept_id
LEFT JOIN services ON services.id= histo_emploi.service_id
LEFT JOIN pers_groupe_emplois groupe ON groupe.id = histo_emploi.groupe_emploi_id
LEFT JOIN branches on branches.id = histo_emploi.branche_id;
