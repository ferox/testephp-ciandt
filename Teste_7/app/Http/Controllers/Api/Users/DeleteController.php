<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * @OA\Delete(
 * path="/api/users",
 * tags={"API CRUD"},
 * security={{"bearerAuth": {}}},
 * summary="Remove usuário",
 * description="Exclui usuário",
 * operationId="deleteUser",
 * @OA\RequestBody(
 *    required=true,
 *    description="Informações do usuário",
 *    @OA\JsonContent(
 * 		@OA\Property(property="email", type="string", format="email", example="admin@gnu.org", description="E-mail")
 *  )
 * ),
 * @OA\Response(
 *    response=200,
 *    description="Retorna mensagem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Deletado")
 *    )
 * ),
 * @OA\Response(
 *    response=204,
 *    description="Retorna mensagem",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Deletado")
 *    )
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
class DeleteController extends Controller
{
    public function index(Request $request)
    {

    	$authUser = $request->user();

    	if ("admin" != $authUser->role)
    		return response()->json("Não Autenticado", 401);

    	$existsUser = User::where('email', $request->input("email"))->get();

    	if (empty($existsUser[0]))
    		return response()->json("Não Encontrado", 404);

    	if ("admin" == $existsUser[0]->role)
    		return response()->json("Não Autenticado", 401);

    	try {
    			$existsUser->toQuery()->delete([
    				'email' => $request->input("email"),
    			]);

                \App\Helper\FileWrite::write();

	    		return response()->json("Deletado", 200);
    	}
    	catch (Exception $e) {
			return response()->json("Erro Interno do Servidor", 501);
    	}
    }
}
