<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\AuthorCollection;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AuthorCollection(Author::OrderBy('name','asc')->paginate(10),
    );
        //get http://127.0.0.1:8000/api/authors
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newAuthor = Author::addAuthor($request->all());
        return response()->json($newAuthor, 201);
        //post http://127.0.0.1:8000/api/authors
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);
        if ($author) {
           return new AuthorResource($author);
            //get http://127.0.0.1:8000/api/authors/{id}
        }else {
            return response()->json('Not Found', 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Author  $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Author $author)
    {
        $updateAuthor = Author::updateAuthor($author, $request->all());
        return response()->json($updateAuthor, 200);
        // patch http://127.0.0.1:8000/api/authors/{id}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Author $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response()->json('', 204);
        // DELETE http://127.0.0.1:8000/api/authors/{id}
    }

    /**
     * @OA\Get(
     *      path="/authors",
     *      operationId="getAllAuthor",
     *      tags={"Tests"},

     *      summary="Get List Of Authors",
     *      description="Afficher tout les auteurs",
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

    public function getAllAuthors(){
        return serviceApi("authors");
    }

    /**
     * @OA\Get(
     *      path="/authors/6",
     *      operationId="getIdAuthor",
     *      tags={"Tests"},

     *      summary="Get Author By ID",
     *      description="Afficher un Auteur particulier",
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

    public function getIdAuthors(){
        return serviceApi("id");
    }

    /**
     * @OA\Post(
     *      path="/authors/",
     *      operationId="postNewAuthor",
     *      tags={"Tests"},

     *      summary="Post New Author",
     *      description="Ajouter un nouvel Auteur",
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

    public function postNewAuthor(){
        return serviceApi("authors");
    }

    /**
     * @OA\Patch(
     *      path="/authors/6",
     *      operationId="updateAuthor",
     *      tags={"Tests"},

     *      summary="Update Author By ID",
     *      description="Modifier un livre",
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

    public function updateAuthor(){
        return serviceApi("id");
    }

    /**
     * @OA\Delete(
     *      path="/authors/34",
     *      operationId="deleteAuthor",
     *      tags={"Tests"},

     *      summary="Delete Author By ID",
     *      description="Supprimer un Auteur depuis son ID",
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

    public function deleteAuthor(){
        return serviceApi("id");
    }
}
