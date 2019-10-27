SET character_set_client = utf8 ;
SET character_set_connection = utf8 ;
CREATE DATABASE IF NOT EXISTS BOOKS DEFAULT CHARSET utf8 COLLATE utf8_general_ci;
use BOOKS;
CREATE TABLE IF NOT EXISTS `book`(
`id` INT UNSIGNED AUTO_INCREMENT,
`title` VARCHAR(100) NOT NULL,
`author` VARCHAR(100) NOT NULL,
`pages` INT UNSIGNED default 0,
`publiser` VARCHAR(100) NOT NULL,
`publis_time` DATE,
PRIMARY KEY ( `id` )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into book values(1,"book中文1","author1",100,"publiser1","2021-2-2");
insert into book values(2,"book2","author2",200,"publiser中文2","2022-2-2");
insert into book values(3,"book3","author3",300,"publiser3","2023-2-2");
insert into book values(4,"book4","author4中文",400,"publiser4","2024-2-2");
insert into book values(5,"book5","author5",500,"publiser5","2025-2-2");