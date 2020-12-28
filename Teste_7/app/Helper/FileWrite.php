<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\User as UserResource;
use App\Models\User;

class FileWrite
{
    public static function write()
    {
      $filename = "api_usuarios.txt";
      $users = UserResource::collection(User::all());
      Storage::disk('local')->put($filename, json_encode($users, JSON_PRETTY_PRINT));
    }
}