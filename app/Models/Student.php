<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'ra';

    protected $table = 'students';

    public $incrementing = false;
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'ra'
    ];
}
