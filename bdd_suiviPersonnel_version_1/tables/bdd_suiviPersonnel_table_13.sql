CREATE TABLE `pers_type_materiels`
(
    `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `code` bigint(20) NOT NULL,
    `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL ,
    `lien_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pers_materiels`
(
    `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `employer_id`  bigint(20) UNSIGNED NOT NULL  REFERENCES `employers` (`id`) ON DELETE CASCADE ,
    `description_id`  bigint(20)  NOT NULL REFERENCES `pers_type_materiels` (`id`) ON DELETE CASCADE  ,
    `num_serie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL ,
    `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 ALTER TABLE `pers_materiels` ADD `date_fin` DATE NULL DEFAULT NULL AFTER `date`;
--ALTER TABLE `pers_materiels` ADD FOREIGN KEY (`employer_id`) REFERENCES `employers`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--ALTER TABLE `pers_materiels`ADD FOREIGN KEY (`description_id`) REFERENCES `pers_type_materiels`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

