<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class foccoPessoa extends Model
{
    use HasFactory;
    protected $connection = 'foccoOracle';

    protected $fillable=[
        'FIL_Codigo'

    ];
    protected $primaryKey = 'FIL_Codigo';
    protected $table = 'FIL_EMPRESA';
    public $timestamps = false;
}
