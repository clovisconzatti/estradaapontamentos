<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        , 'user_id'
        , 'ativo'
        , 'user_alteracao_id'
        , 'user_delete_id'

    ];

    protected $primaryKey = 'id';
    protected $table = 'movimento';
    use SoftDeletes;
    protected $dates=['deleted_at'];
}
