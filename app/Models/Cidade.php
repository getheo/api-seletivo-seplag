<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'cidade';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['cid_nome', 'cid_uf'];

    public function endereco()
    {
        return $this->hasMany(Endereco::class, 'cid_id');
    }

}
