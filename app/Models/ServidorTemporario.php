<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServidorTemporario extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'servidor_temporario';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'st_data_admissao', 'st_data_demissao'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
