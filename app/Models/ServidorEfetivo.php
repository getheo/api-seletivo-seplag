<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServidorEfetivo extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'servidor_efetivo';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'se_matricula'];
}
