<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoPessoa extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'foto_pessoa';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'fp_data', 'fp_bucket', 'fp_hash'];
}
