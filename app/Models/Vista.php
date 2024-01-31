<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Vista extends Model
{
    use HasFactory;

    public static function verificar($user_u){
        $query = DB::select("SELECT * FROM users WHERE email='$user_u'");
        return $query;
    }
}
