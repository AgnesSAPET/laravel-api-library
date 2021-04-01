<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new BookCollection(Book::OrderBy('publication_year','asc')->OrderBy('title', 'asc')->paginate(10));
        //get http://127.0.0.1:8000/api/books
    }

    public function search(Request $request)
    {
        $books = Book::where([
            ['title', '!=', Null],
            [function($query) use ($request) {
                if (($term = $request->title)) {
                    $query->orWhere('title', 'LIKE', '%' .$term . '%')->get();
                }
            }]
        ])
            ->OrderBy('publication_year', 'asc')
            ->OrderBy('title', 'asc')
            ->paginate(10);
        return new BookCollection($books);
        //get http://127.0.0.1:8000/api/books
    }


    /**
     * Store a newly created resource in storage.
     *@param  Book $book
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        $newBook = Book::addBook($request->all());
        return response()->json($newBook, 201);
        //post http://127.0.0.1:8000/api/books
    }

    /**
     * Display the specified resource.
     *
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new BookResource($book);
        //get http://127.0.0.1:8000/api/books/{id}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Book $book)
    {
        $updateBook = Book::updateBook($book, $request->all());
        return response()->json($updateBook, 200);
        // patch http://127.0.0.1:8000/api/books/{id}
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json('', 204);
        // DELETE http://127.0.0.1:8000/api/books/{id}
    }

    /**
     * @OA\Get(
     *      path="/books",
     *      operationId="getAllBook",
     *      tags={"Tests"},

     *      summary="Get List Of Books",
     *      description="Afficher tout les livres",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */

    public function getAllBooks(){
        return serviceApi("books");
    }

    /** @OA\Get(
        *      path="/books/12",
        *      operationId="getIdBooks",
        *      tags={"Tests"}, 

        * 
        *      summary="Get Books By ID ",
        *      description="Afficher un livre",
        *      @OA\Response(
        *          response=200,
        *          description="Successful operation",
        *          @OA\MediaType(
        *           mediaType="application/json",
        *      )
        *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     * */

    public function getIdBooks(){
        return serviceApi("id");
    }

    /** @OA\Post(
        *      path="/books/",
        *      operationId="postNewBook",
        *      tags={"Tests"}, 

        * 
        *      summary="Post New Book ",
        *      description="Ajouter un nouveau livre",
        *      @OA\Response(
        *          response=200,
        *          description="Successful operation",
        *          @OA\MediaType(
        *           mediaType="application/json",
        *      )
        *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     * */

    public function postNewBook(){
        return serviceApi("books");
    }

    /** @OA\Patch(
        *      path="/books/6",
        *      operationId="updateBook",
        *      tags={"Tests"}, 

        * 
        *      summary="Update Book By ID ",
        *      description="Modifier un livre depuis son ID",
        *      @OA\Response(
        *          response=200,
        *          description="Successful operation",
        *          @OA\MediaType(
        *           mediaType="application/json",
        *      )
        *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     * */

    public function updateBook(){
        return serviceApi("id");
    }

    /** @OA\Delete(
        *      path="/books/14",
        *      operationId="deleteBook",
        *      tags={"Tests"}, 

        * 
        *      summary="Delete Book by ID ",
        *      description="Supprimer un livre depuis son ID",
        *      @OA\Response(
        *          response=200,
        *          description="Successful operation",
        *          @OA\MediaType(
        *           mediaType="application/json",
        *      )
        *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     * */

    public function deleteBook(){
        return serviceApi("id");
    }
}

