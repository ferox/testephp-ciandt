<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\Models\User;

/**
 * @OA\Post(
 * path="/api/users",
 * tags={"API CRUD"},
 * security={{"bearerAuth": {}}},
 * summary="Criar usuário",
 * description="Cria novo usuário",
 * operationId="creareUser",
 * @OA\RequestBody(
 *    required=true,
 *    description="User Object",
 *    @OA\JsonContent(ref="#/components/schemas/UserSchema")
 * ),
 * @OA\Response(
 *    response=200,
 *    description="Retorna usuário criado",
 *    @OA\JsonContent(ref="#/components/schemas/UserSchema")
 * ),
 * @OA\Response(
 *    response=401,
 *    description="Não Autenticado",
 *    @OA\JsonContent(@OA\Property(property="message", type="string", example="Não Autenticado"))
 * ),
 * @OA\Response(
 *    response=501,
 *    description="Erro Interno do Servidor",
 *    @OA\JsonContent(@OA\Property(property="message", type="string", example="Erro Interno do Servidor"))
 * )
 *)
 */
class CreateController extends Controller
{
    public function index(Request $request)
    {
    	$authUser = $request->user();

    	if ("admin" != $authUser->role)
    		return response()->json("Não Autenticado", 401);

    	$existsUser = User::where('email', $request->input("email"))->get();

    	if (!empty($existsUser[0]))
			return response()->json("Erro Interno do Servidor", 501);

    	try {
    			User::create([
    				'name' => $request->input("name"),
    				'lastname' => $request->input("lastname"),
    				'phone' => $request->input("phone"),
    				'email' => $request->input("email"),
					'password' => Hash::make('123456'),
					'role' => 'user'
    			]);

		    	$newUser = User::where('email', $request->input("email"))->get();
				if (empty($newUser[0]))
					return response()->json("Erro Interno do Servidor", 501);

                \App\Helper\FileWrite::write();

	    		return response()->json(new UserResource(User::find($newUser[0]->id)), 200);
    	}
    	catch (Exception $e) {
			return response()->json("Erro Interno do Servidor", 501);
    	}
    }
}
