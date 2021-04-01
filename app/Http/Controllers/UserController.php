<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::OrderBy('name','asc'));
        //get http://127.0.0.1:8000/api/users
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'firstName' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['firstName'] =  $user->firstName;
   
        return $this->sendResponse($success, 'User register successfully.');
        //post http://127.0.0.1:8000/api/users
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->accessToken; 
            $success['name'] =  $user->name;
            $success['firstName'] =  $user->firstName;
   
            return response($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'firstName' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['firstName'] =  $user->firstName;
   
        return $this->sendResponse($success, 'User update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
   
        return $this->sendResponse([], 'Product deleted successfully.');
        // DELETE http://127.0.0.1:8000/api/users/{id}
    }

    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getAllUser",
     *      tags={"Tests"},

     *      summary="Get List Of Users",
     *      description="Afficher tout les Utilisateurs",
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

    public function getAllUsers(){
        return serviceApi("users");
    }

    /** @OA\Patch(
        *      path="/users/6",
        *      operationId="updateUser",
        *      tags={"Tests"},
        * 
        *      summary="Update User By ID ",
        *      description="Modifier un user en le trouvant par son ID",
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

    public function updateUser(){
        return serviceApi("id");
    }

    /** @OA\Delete(
        *      path="/users/5",
        *      operationId="deleteUser",
        *      tags={"Tests"},
        * 
        *      summary="Delete User By ID ",
        *      description="Supprimer un utilisateur depuis son ID si autorisation OK",
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

    public function deleteUser(){
        return serviceApi("id");
    }

}