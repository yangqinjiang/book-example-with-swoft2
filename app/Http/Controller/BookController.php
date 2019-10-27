<?php declare(strict_types=1);

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Db\DB;
use App\Model\Entity\Book;

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

         //插入一条数据
         /*
         insert into book values(1,"书名1","作者1",100,"出版社1","2021-2-2");
         insert into book values(2,"书名2","作者2",200,"出版社2","2022-2-2");
         insert into book values(3,"书名3","作者3",300,"出版社3","2023-2-2");
         insert into book values(4,"书名4","作者4",400,"出版社4","2024-2-2");
         insert into book values(5,"书名5","作者5",500,"出版社5","2025-2-2");
         */
    }
    /**
     * @RequestMapping(route="list",method=RequestMethod::GET)
     * @param Response  $response
     * @return Response
     */
    public function index( Response $response) : Response{
        
        $books = DB::select('select id,title,author,pages,publiser,publis_time from `book`;');
        return $response->withData( ['errno'=>0 , 'data'=>$books]  );
    }

     /**
     * @RequestMapping(route="save",method=RequestMethod::POST)
     * @param Response  $response
     * @return Response
     */
    public function save( Request $request, Response $response) : Response{
        //id=0&title=&author=&pages=&publiser=&publis_time=
        $data = $request->post();
        $id = intval($request->post('id', 0));
        $title = $request->post('title', '-');
        $author = $request->post('author', '-');
        $publiser = $request->post('publiser', '-');
        $publis_time = $request->post('publis_time', '-');
        $pages = intval($request->post('pages', 0));

        if( empty($id)){
            //增加
            $book = Book::new();
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setPubliser($publiser);
            $book->setPublisTime($publis_time);
            $book->setPages($pages);
            $book->save();
        }else{
            //修改
            $book = Book::find($id);
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setPubliser($publiser);
            $book->setPublisTime($publis_time);
            $book->setPages($pages);
            $book->update();
        }
          
        return $response->withData( ['errno'=>0,'input'=>$data ]  );
    }

    //
         /**
     * @RequestMapping(route="delete",method=RequestMethod::POST)
     * @param Response  $response
     * @return Response
     */
    public function delete(  Request $request,Response $response) : Response{
        // input id
        $data = $request->post();
        $id = intval($request->post('id', 0));
        if ($id > 0){
            Book::where('id',$id )->limit(1)->delete();
        }
        
        return $response->withData( ['errno'=>0 ]  );
    }
}