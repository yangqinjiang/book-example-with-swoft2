<?php declare(strict_types=1);

namespace App\Http\Controller;

use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Message\Response;

/**
 * @Controller(prefix="/v1/book")
 */
class BookController
{
    /**
     * @RequestMapping(route="list",method=RequestMethod::GET)
     * @param Response  $response
     * @return Response
     */
    public function index( Response $response) : Response{
        
        //数组
        $data = [
            ["id"=>1,"title"=>"书名1","author"=>"作者1","pages"=>"页数1","publiser"=>"出版社1","publis_time"=>date('Y-m-d')],
            ["id"=>2,"title"=>"书名2","author"=>"作者2","pages"=>"页数2","publiser"=>"出版社2","publis_time"=>date('Y-m-d')],
            ["id"=>3,"title"=>"书名3","author"=>"作者3","pages"=>"页数3","publiser"=>"出版社3","publis_time"=>date('Y-m-d')],
            ["id"=>4,"title"=>"书名4","author"=>"作者4","pages"=>"页数4","publiser"=>"出版社4","publis_time"=>date('Y-m-d')],
            ["id"=>5,"title"=>"书名5","author"=>"作者5","pages"=>"页数5","publiser"=>"出版社5","publis_time"=>date('Y-m-d')],

        ];
        return $response->withData( ['errno'=>0 , 'data'=>$data]  );
    }

        /**
     * @RequestMapping(route="save",method=RequestMethod::POST)
     * @param Response  $response
     * @return Response
     */
    public function save(  Response $response) : Response{
        
        //数组
        //TODO:保存数据 post.book
        return $response->withData( ['errno'=>0 ]  );
    }
}