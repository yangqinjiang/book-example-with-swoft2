#!/usr/bin/env bash
################################################################################
# 初始化数据库,导入books.sql文件的数据
################################################################################
echo "初始化数据库,导入books.sql文件的数据"
# library-on-mysql-srv 是docker-compose.yml 文件定义的services
docker exec -i library-on-mysql-srv sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < books.sql
echo "OK"