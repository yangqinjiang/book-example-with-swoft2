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
`publis_time` VARCHAR(11) NOT NULL,
PRIMARY KEY ( `id` )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into book values(1,"PHP、MySQL与JavaScript学习手册（第四版）","[美] Robin Nixon（罗宾·尼克松",704,"中国电力出版社","2015-12-01");
insert into book values(2,"鸟哥的Linux私房菜 基础学习篇 第四版","鸟哥",602,"人民邮电出版社","2018-10-01");
insert into book values(3,"深度学习 [deep learning]","[美] Ian，Goodfellow，[加] Yoshua，Bengio，[加] Aaron ",602,"人民邮电出版社","2017-08-01");
insert into book values(4,"数学之美（第二版）","吴军",312,"人民邮电出版社","2014-11-01");
insert into book values(5,"中国科幻基石丛书：三体（套装1-3册）","刘慈欣",900,"重庆出版社","2008-01-01");