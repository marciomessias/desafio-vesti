<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $primaryKey = 'referencia';

    protected $fillable = [
        'referencia',
        'nome',
        'descricao',
        'preco',
        'promocao',
        'composicao',
        'marca',
        'integrado'
    ];

    public function variacao(): HasMany
    {
        return $this->hasMany(Variacao::class);
    }
}
