<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emailverification extends Model
{
    /** @use HasFactory<\Database\Factories\EmailverificationFactory> */
    use HasFactory;
    protected $fillable = ['email', 'code', 'expires_at'];
}
