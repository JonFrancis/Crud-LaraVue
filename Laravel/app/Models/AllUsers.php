<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllUsers extends Model
{
    use HasFactory;

    protected $table = 'allusers';

    protected $fillable = [
        'Username',
        'Password',
        'First_Name',
        'Last_Name',
        'Age',
        'Cellphone',
    ];
}
