<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Models\User;

/**
 * @OA\Put(
 * path="/api/users",
 * tags={"API CRUD"},
 * security={{"bearerAuth": {}}},
 * summary="Editar usuário",
 * description="Edita um usuário existente",
 * operationId="updateUser",
 * @OA\RequestBody(
 *    required=true,
 *    description="Informações do usuário",
 *    @OA\JsonContent(ref="#/components/schemas/UserSchema")
 * ),
 * @OA\Response(
 *    response=200,
 *    description="Retorna usuário atualizado",
 *    @OA\JsonContent(ref="#/components/schemas/UserSchema")
 * ),
 * @OA\Response(
 *    response=401,
 *    description="Não Autenticado",
 *    @OA\JsonContent(@OA\Property(property="message", type="string", example="Não Autenticado"))
 * ),
 * @OA\Response(
 *    response=404,
 *    description="Não Encontrado",
 *    @OA\JsonContent(@OA\Property(property="message", type="string", example="Não Encontrado"))
 * ),
 * @OA\Response(
 *    response=501,
 *    description="Erro Interno do Servidor",
 *    @OA\JsonContent(@OA\Property(property="message", type="string", example="Erro Interno do Servidor"))
 * )
 *)
 */
class UpdateController extends Controller
{
    public function index(Request $request)
    {
    	$authUser = $request->user();

    	if ("admin" != $authUser->role)
    		return response()->json("Não Autenticado", 401);

    	$editUser = User::where('email', $request->input("email"))->get();

    	if (empty($editUser[0]))
    		return response()->json("Não Encontrado", 404);

    	if ("admin" == $editUser[0]->role)
    		return response()->json("Não Autenticado", 401);

    	try {
    			$editUser->toQuery()->update([
    				'name' => $request->input("name"),
    				'lastname' => $request->input("lastname"),
    				'phone' => $request->input("phone"),
    				'email' => $request->input("email")
    			]);

                \App\Helper\FileWrite::write();

	    		return response()->json(new UserResource(User::find($editUser[0]->id)), 200);
    	}
    	catch (Exception $e) {
            return response()->json("Erro Interno do Servidor: \n" . $e->getMessage, 501);
    	}
    }
}
