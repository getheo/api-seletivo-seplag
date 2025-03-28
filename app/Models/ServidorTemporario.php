<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServidorTemporario extends Model
{
    use HasFactory;

    // Nome da tabela associada à model (opcional)
    protected $table = 'servidor_temporario';

    // Colunas que podem ser preenchidas em massa (opcional)
    protected $fillable = ['pes_id', 'st_data_admissao', 'st_data_demissao'];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pes_id')->with('endereco');
    }
}
