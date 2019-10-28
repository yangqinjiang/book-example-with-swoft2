################################################################################
# 基于 mysql:5.6.46 ,编译一个docker镜像,带导入初始化数据的功能
# @build-example docker build . -f Dockerfile -t yangqinjiang/import_db_to_mysql
################################################################################
FROM mysql:5.6.46
LABEL maintainer="yangqinjiang <yangqinjiang@qq.com>" version="1.0"

# 初始化数据库,导入books.sql文件的数据
COPY books.sql  /docker-entrypoint-initdb.d