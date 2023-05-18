<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pessoa extends Model
{

    public $timestamps = false;
    protected $fillable= [
        'id'
        , 'codfocco'
        , 'nome'
        , 'cliente'
        , 'fornecedor'

    ];

    protected $primaryKey = 'id';
    protected $table = 'pessoa';
}
