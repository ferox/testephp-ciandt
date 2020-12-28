<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function index()
	{
		return response()->json(['message' => 'Não Encontrado'], 404);
	}
}
