<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeEndereco extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'unidade_endereco';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['unid_id', 'end_id'];
}
