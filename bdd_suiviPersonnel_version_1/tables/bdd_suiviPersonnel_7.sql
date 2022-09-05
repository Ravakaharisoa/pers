CREATE TABLE paie_avantage_en_natures (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(255) DEFAULT (NULL),
	designation VARCHAR(255) DEFAULT(NULL)   ,
	unite VARCHAR(50) DEFAULT (NULL)
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 CREATE TABLE paie_prime_indemnites (
	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	code VARCHAR(255) DEFAULT (NULL),
	designation VARCHAR(255) DEFAULT (NULL)   ,
	unite VARCHAR(50) DEFAULT (NULL)
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `paie_avantage_en_natures` (`id`, `code`, `designation`, `unite`) VALUES (NULL, NULL, 'autre', NULL);
INSERT INTO `paie_prime_indemnites` (`id`, `code`, `designation`, `unite`) VALUES (NULL, NULL, 'autre', NULL);
