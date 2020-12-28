<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="API Usuários - Documentação", version="1.0.0")
 * tags={"API CRUD"},
 * @OA\Schema(
 *	schema="UserSchema",
 *  required={"name","lastname","phone","email"},
 *  @OA\Property(property="name", type="string", format="name", example="Richard", description="Nome"),
 *  @OA\Property(property="lastname", type="string", format="lastname", example="Stallman", description="Sobrenome"),
 *  @OA\Property(property="phone", type="string", format="phone", example="(00) 00000-0000", description="Telefone"),
 *  @OA\Property(property="email", type="string", format="email", example="rms@gnu.org", description="E-mail")
 * )
 * @OA\Schema(
 *	schema="AuthSchema",
 *  required={"email","password"},
 *  @OA\Property(property="email", type="string", format="email", example="root@gnu.org", description="E-mail"),
 *  @OA\Property(property="password", type="string", format="password", example="fr33s0ftw4re#21", description="Senha")
 * )
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="http",
 *      scheme="Bearer",
 *      bearerFormat="JWT",
 * )
 * @OA\Schema(
 *	schema="TokenResponseSchema",
 *  required={"access_token","expires_at", "token_type"},
 *  @OA\Property(property="access_token", type="string", format="access_token", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiMzY5Y2E3MTRmMTJmZjkzNTQ2NzJmZWIwZjg5ZmU4YTBkOTkzZTJmZjY1NzBjNjZhYzMxNWVhOGM3MzU1NGY2OTJmYmM5MjE0Y2FjY2E1ZTciLCJpYXQiOjE2MDM3NTk0NjQsIm5iZiI6MTYwMzc1OTQ2NCwiZXhwIjoxNjM1Mjk1NDY0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.n-iBjM_41qQgdcQwXF1nQVwADNT_m9qzdBjufFfWopr_QZmB4Gto1TMP918JXtec1E2qbMZwsJiivN5NKIA0hyssum3a2F4e9yWS3Bk9lgwym7oYGwYWQdr6js5_SVcNxWK-OUjXMzTDb7QipJXyhIBf1PYnQTpKTxDVZvWIv6Zdx8Ubb1KWneOiK3iPN9qT9vMJpJqO1UPjnDOSqgwDh06CKZSkWkFXecKCs3ceA1baxP2duniHXvfC_MC3XA7op0fr84erZMQhBmG7dNK7qUkIwglLGdeu1wDyVwDvuSC-KNbqGzoq1MjMWZv7YIu4fmQ47HN9Jryoi9sihHG0fj5TFvQD9ZOKUPXs0Phlb00gylwUDB1N2LXuW-LH8eO8fWJN4bqwOKRoyWfzzCC1uuDM0BAVE3HSUylMwptQy87Lzo1_PATN__yr3wsOybn_oRY57n9CZjgwCU1U2l9xVEvuR64FsH-_SXQjDQhP62hvuBn0TFbOl60LBjA5-fgek-qnaucwHdegS4dmjpMRNVj2_S93Hv8O06W698EdeB2dRP3woLpXQjQ7V0YQS_oxVXwZZceUmKuxDE7mHhiE2b5i2A5xYj1y2JWc4Bcy9iP8cAHKp6MAnv261FiXLIG7ZTk77nFSlQNJ51ZH_1WtO0QQ2rVdha8hK90xr_z1s7g", description="Token de Acesso"),
 *  @OA\Property(property="expires_at", type="string", format="expires_at", example="2020-10-26 18:33:07", description="Validade"),
 *  @OA\Property(property="token_type", type="string", format="token_type", example="Bearer", description="Bearer Token...")
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
