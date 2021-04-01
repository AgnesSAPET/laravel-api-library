<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Resources\GenreResource;
use App\Http\Resources\GenreCollection;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new GenreCollection(Genre::OrderBy('name','asc')->paginate(6));
        //get http://127.0.0.1:8000/api/genres
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newGenre = Genre::addGenre($request->all());
            return response()->json($newGenre, 201);
            //post http://127.0.0.1:8000/api/genres
    }

    /**
     * Display the specified resource.
     *
     * @param  Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        if (true) {
            return new GenreResource($genre);
            //get http://127.0.0.1:8000/api/genres/{id}
        }else {
            return response()->json('Not Found', 404);
        }
        
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
     * @param  Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $updateGenre = Genre::updateGenre($genre, $request->all());
        return response()->json($updateGenre, 200);
        // patch http://127.0.0.1:8000/api/genres/{id}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->json('', 204);
        // DELETE http://127.0.0.1:8000/api/genres/{id}
    }

    /**
     * @OA\Get(
     *      path="/genres",
     *      operationId="getAllGenre",
     *      tags={"Tests"},
     * 
     *      summary="Get List Of Genres",
     *      description="Voir tout les genres",
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

    public function getAllGenres(){
        return serviceApi("genres");
    }

    /** @OA\Get(
        *      path="/genres/6",
        *      operationId="getIdGenre",
        *      tags={"Tests"},
        * 
        *      summary="Get Genre By ID ",
        *      description="Regarder un genre",
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

    public function getIdGenres(){
        return serviceApi("id");
    }

    /**
     * @OA\Post(
     *      path="/genres",
     *      operationId="postNewGenre",
     *      tags={"Tests"},
     * 
     *      summary="Post New Genre",
     *      description="Ajouter un nouveau genre",
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

    public function postNewGenre(){
        return serviceApi("genres");
    }

    /** @OA\Patch(
        *      path="/genres/6",
        *      operationId="updateGenre",
        *      tags={"Tests"},
        * 
        *      summary="Update Genre By ID ",
        *      description="Modifier un genre en le trouvant par son ID",
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

    public function updateGenre(){
        return serviceApi("id");
    }

    /** @OA\Delete(
        *      path="/genres/5",
        *      operationId="deleteGenre",
        *      tags={"Tests"},
        * 
        *      summary="Delete Genre By ID ",
        *      description="Supprimer un genre depuis son ID",
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

    public function deleteGenre(){
        return serviceApi("id");
    }
}
