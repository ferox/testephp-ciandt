<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * @OA\Post(
 * path="/api/auth/login",
 * summary="Token",
 * description="Autenticação",
 * operationId="authLogin",
 * tags={"OAuth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Usuário e senha",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="fernando@gnu.org"),
 *       @OA\Property(property="password", type="string", format="password", example="123456"),
 *    ),
 * ),
 * @OA\Response(
 *    response=200,
 *    description="Token",
 *    @OA\JsonContent(ref="#/components/schemas/TokenResponseSchema")
 * ),
 * @OA\Response(
 *    response=401,
 *    description="Não Autenticado",
 *    @OA\JsonContent(@OA\Property(property="message", type="string", example="Não Autenticado"))
 * ),
 * @OA\Response(
 *    response=403,
 *    description="Proibido",
 *    @OA\JsonContent(@OA\Property(property="message", type="string", example="Proibido"))
 * )
 *)
 */
class LoginController extends Controller
{
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
        	return response()->json(['message' => 'Não Autenticado'], 401);

        $user = $request->user();

        if("admin" != $user->role)
        	return response()->json(['message' => 'Proibido'], 403);

        $tokenResult = $user->createToken(env('API_ACCESS_SECRET', ''));
        $token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addWeeks(1);

        $token->save();

        return response()->json([
        	'access_token' => $tokenResult->accessToken,
        	'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'token_type' => "Bearer"
        ]);
    }
}