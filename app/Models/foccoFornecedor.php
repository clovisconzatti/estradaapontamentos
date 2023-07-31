<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foccoFornecedor extends Model
{
    use HasFactory;
    protected $connection = 'focco';

    protected $fillable=[
        'ID'
        , 'COD_FOR'
        , 'DESCRICAO'
    ];
    protected $primaryKey = 'ID';
    protected $table = 'FOCCO3I.TFORNECEDORES';
    public $timestamps = false;
}
