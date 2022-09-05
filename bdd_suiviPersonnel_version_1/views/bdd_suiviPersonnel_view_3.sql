CREATE OR REPLACE VIEW v_liste_employe_demissioner as
SELECT
    v_employe.`id`,
    v_employe.matricule,
    v_employe.nom_stagiaire,
    v_employe.prenom_stagiaire,
    v_employe.genre_stagiaire,
    v_employe.fonction_stagiaire,
    v_employe.mail_stagiaire,
    v_employe.telephone_stagiaire,
    v_employe.user_id,
    v_employe.photos,
    v_employe.cin,
    v_employe.nom_departement,
    v_employe.nom_service,
    v_employe.activiter,
    v_employe.nom_branche,
    pers_demissions.nom_fichier,
    pers_demissions.contrat_id,
    pers_demissions.date_demission,
    pers_demissions.entreprise_id as ancien_entreprise
FROM `v_employe`
JOIN pers_demissions ON pers_demissions.employer_id = v_employe.id;
