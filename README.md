# 运行方式
#### 前提: docker 19+, Compose 1.24+
- 在当前目录下, 在终端上运行 `docker-compose up`, 第一次运行,因为要下载依赖,可能比较慢
- docker的mysql容器运行后,自动导入 `scripts/ImportDbToMysql/books.sql` 原始数据库,详见 docker-compose.yml的db定义
- 关闭系统 `docker-compose down`

- 在浏览器上打开 `http://localhost:18306/`


## 手动导入sql文件
`docker exec -i library-on-mysql-srv sh -c 'exec mysql -uroot -p"$MYSQL_ROOT_PASSWORD"' < scripts/ImportDbToMysql/books.sql`


# 项目需求
```

1、编写一个简单的书籍管理系统：，要求
  1）程序和数据采用UTF-8编码
  2）在数据库中添加如下数据表（数据类型自行设计）：
    字段名    含义  
    title    书名
    author   作者
    pages    页数
    publiser 出版社
    publis_time 出版时间
    
  3）使用Swoft来完成 （https://www.swoft.org）。
  4）程序的基本功能：
     a)从数据库中加载书籍列表并展示：
     b）实现对书籍基本信息的维护（包括增加新书籍、修改名称、作者、页数、出版社和出版时间等：以及删除书籍）
  5）附件功能（选做）：实现对书籍增加tag（标签）功能，每本书可以有多个标签。如一本关于java的书籍，可以添加入“java”，“编程”等多个标签
  
2、完成题目后，请将项目源码打包，与个人简历一起，发送到wuyi@hysgz.com
```