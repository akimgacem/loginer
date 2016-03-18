CREATE TABLE `loginer_users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`oauth` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
 	`last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	`picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 	`date_created` datetime NOT NULL,
 	`date_modified` datetime NOT NULL,
 	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;