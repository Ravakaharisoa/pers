CREATE OR REPLACE view v_groupe_categ_emploi as
SELECT
(categ.`id`)categ_id,
categ.`categorie_emploi`,
categ.`groupe_emploi_id`,
groupe.groupe_emploi
FROM `pers_categorie_emplois`categ
LEFT JOIN pers_groupe_emplois groupe
ON categ.`groupe_emploi_id` = groupe.id;

CREATE OR REPLACE view v_materiels AS
SELECT
pers_materiels.id ,
employer_id, nom_emp, prenom_emp,code, description,lien_image, num_serie, date,date_fin
 FROM pers_materiels, pers_type_materiels, employers
  Where employers.id=pers_materiels.employer_id
   AND pers_materiels.description_id=pers_type_materiels.id

CREATE OR REPLACE view v_historique_sanctions AS
SELECT
pers_historique_sanctions.id, (employers.id) employer_id, nom_emp, prenom_emp, type,(pers_mesure_administratives.id) admin_id,
 (pers_mesure_administratives.descriptions) description,(pers_mesure_disciplinaires.id) discipline_id,(pers_mesure_disciplinaires.nom_discipline) discipline,
 (pers_sanctions.id) sanction_id, pers_sanctions.nom_saction, pers_historique_sanctions.duree_sanction, date_sanction, supprimer, statut
 FROM employers,pers_sanctions, pers_historique_sanctions,pers_mesure_disciplinaires,pers_mesure_administratives
  Where employers.id=pers_historique_sanctions.employer_id
  and pers_sanctions.id=pers_historique_sanctions.sanction_id
   AND pers_mesure_disciplinaires.id=pers_historique_sanctions.discipline_id
    AND pers_mesure_administratives.id=pers_historique_sanctions.description_id;
