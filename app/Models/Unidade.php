<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Unidade extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'unidade';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['unid_id', 'unid_nome', 'unid_sigla'];

    public function unidadeEndereco(): HasOne
    {
        return $this->HasOne(UnidadeEndereco::class, 'unid_id')->with('endereco');
    }

}
