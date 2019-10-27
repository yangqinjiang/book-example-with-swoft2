<?php declare(strict_types=1);

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Message\Response;
use Swoft\Db\DB;

/**
 * @Controller(prefix="/v1/book")
 */
class BookController
{
        /**
     * @RequestMapping(route="create_db",method=RequestMethod::GET)
     * @param Response  $response
     * @return Response
     */
    public function create_db() : Response{
        //建数据库，该命令的作用：
            //  1. 如果数据库不存在则创建，存在则不创建。
            //  2. 创建RUNOOB数据库，并设定编码集为utf8
        //CREATE DATABASE IF NOT EXISTS BOOKS DEFAULT CHARSET utf8 COLLATE utf8_general_ci;

        //创建表
        $sql = "CREATE TABLE IF NOT EXISTS `book`(
            `id` INT UNSIGNED AUTO_INCREMENT,
            `title` VARCHAR(100) NOT NULL,
            `author` VARCHAR(100) NOT NULL,
            `pages` INT UNSIGNED default 0,
            `publiser` VARCHAR(100) NOT NULL,
            `publis_time` DATE,
            PRIMARY KEY ( `id` )
         )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    }
    /**
     * @RequestMapping(route="list",method=RequestMethod::GET)
     * @param Response  $response
     * @return Response
     */
    public function index( Response $response) : Response{
        
        //数组
        $data = [
            ["id"=>1,"title"=>"书名1","author"=>"作者1","pages"=>"1","publiser"=>"出版社1","publis_time"=>date('Y-m-d')],
            ["id"=>2,"title"=>"书名2","author"=>"作者2","pages"=>"2","publiser"=>"出版社2","publis_time"=>date('Y-m-d')],
            ["id"=>3,"title"=>"书名3","author"=>"作者3","pages"=>"3","publiser"=>"出版社3","publis_time"=>date('Y-m-d')],
            ["id"=>4,"title"=>"书名4","author"=>"作者4","pages"=>"4","publiser"=>"出版社4","publis_time"=>date('Y-m-d')],
            ["id"=>5,"title"=>"书名5","author"=>"作者5","pages"=>"5","publiser"=>"出版社5","publis_time"=>date('Y-m-d')],

        ];
        $books = DB::select('select * from `book`;');
        return $response->withData( ['errno'=>0 , 'data'=>$data,'books'=>$books]  );
    }

     /**
     * @RequestMapping(route="save",method=RequestMethod::POST)
     * @param Response  $response
     * @return Response
     */
    public function save(  Response $response) : Response{
        //form data:
            //{"id":"0","title":"1","author":"1","pages":"1","publiser":"1","publis_time":"2019-10-11"}
        //数组
        //TODO:保存数据 post.book
        return $response->withData( ['errno'=>0 ]  );
    }

    //
         /**
     * @RequestMapping(route="delete",method=RequestMethod::POST)
     * @param Response  $response
     * @return Response
     */
    public function delete(  Response $response) : Response{
        //form data:
         // id: 1
        //数组
        //TODO:保存数据 post.book
        return $response->withData( ['errno'=>0 ]  );
    }
}