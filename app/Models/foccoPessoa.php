<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foccoPessoa extends Model
{
    use HasFactory;
    protected $connection = 'focco';

    protected $fillable=[
        'ID'
        , 'COD_CLI'
        , 'DESCRICAO'

    ];
    protected $primaryKey = 'ID';
    protected $table = 'TCLIENTES';
    public $timestamps = false;
}
