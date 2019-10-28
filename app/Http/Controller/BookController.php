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