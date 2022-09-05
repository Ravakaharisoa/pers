CREATE OR REPLACE view v_pers_prime_indemnite as
SELECT
pers_prime_indemnites.id as pers_prime_id,
pers_prime_indemnites.employer_id,
pers_prime_indemnites.prime_indemnite_id,
pers_prime_indemnites.montant,
pers_prime_indemnites.created_at,
pers_prime_indemnites.devise_id,
devise.devise,
devise.description,
paie_prime_indemnites.designation as nom_prime
FROM `pers_prime_indemnites`
JOIN devise ON devise.id = pers_prime_indemnites.devise_id
JOIN paie_prime_indemnites  ON paie_prime_indemnites.id = pers_prime_indemnites.prime_indemnite_id;

CREATE OR REPLACE view v_pers_avantage_nature as
SELECT
pers_avantage_en_nature.id as avantage_id,
pers_avantage_en_nature.employer_id,
pers_avantage_en_nature.avantage_nature_id,
pers_avantage_en_nature.montant,
pers_avantage_en_nature.created_at,
pers_avantage_en_nature.devise_id,
paie_avantage_en_natures.designation,
devise.devise,
devise.description
FROM `pers_avantage_en_nature`
JOIN devise ON devise.id = pers_avantage_en_nature.devise_id
JOIN paie_avantage_en_natures ON paie_avantage_en_natures.id = pers_avantage_en_nature.avantage_nature_id;
