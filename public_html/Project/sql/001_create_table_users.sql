CREATE TABLE IF NOT EXISTS `Users` (
    `id` INT NOT NULL AUTO_INCREMENT
    ,`email` VARCHAR(100) NOT NULL
    ,`password` VARCHAR(60) NOT NULL
    ,`visibility` int DEFAULT 1,
    ,`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ,PRIMARY KEY (`id`)
    ,UNIQUE (`email`)
)
