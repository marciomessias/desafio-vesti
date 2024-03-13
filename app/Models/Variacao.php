<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variacao extends Model
{
    use HasFactory;

    protected $table = 'variacoes';

    protected $primaryKey = 'variacao';

    protected $fillable = [
        'produto_referencia',
        'variacao',
        'tamanho',
        'cor',
        'quantidade',
        'ordem',
        'unidade'
    ];
}
