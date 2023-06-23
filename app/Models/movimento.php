<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimento extends Model
{

    public $timestamps = false;
    protected $fillable= [
        'id'
        , 'data'
        , 'pessoa'
        , 'doc'
        , 'produto'
        , 'movimento'
        , 'quantidade'
        , 'obs'
        , 'chassi'

    ];

    protected $primaryKey = 'id';
    protected $table = 'movimento';
}
