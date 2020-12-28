<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Models\User;

/**
 * @OA\Get(
 * path="/api/users",
 * tags={"API CRUD"},
 * security={{"bearerAuth": {}}},
 * summary="Lista usuários",
 * description="Retorna usuários",
 * operationId="listUsers",
 * @OA\Response(
 *    response=200,
 *    description="Retorna usuários",
 *    @OA\JsonContent(
 *		@OA\Property(property="users", type="array", @OA\Items(ref="#/components/schemas/UserSchema"))
 *	  )
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
class ReadController extends Controller
{
    public function index()
    {
    	try {
	    	$read = UserResource::collection(User::all());

			\App\Helper\FileWrite::write();

	    	return ["users" => $read];
	    }
	    catch (Exception $e) {
	    	return response()->json("Erro Interno do Servidor: \n" . $e->getMessage, 501);
	    }
    }
}
